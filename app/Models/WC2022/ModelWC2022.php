<?php

namespace App\Models\WC2022;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ModelWC2022 extends Model
{
  use HasFactory;

  protected $table = "table_log";

  public function GetFixtureDataRaw()
  {
    $uri = 'http://api.football-data.org/v4/competitions/WC/matches';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 8af7df158a194baf84b1be9d9ff1fd39';
    $stream_context = stream_context_create($reqPrefs);

    $response = file_get_contents($uri, false, $stream_context);
    return $response;
  }

  public function Update_WC2022_Results()
  {
    $data = $this->GetFixtureDataRaw();
    $json = json_decode($data);
    $matches = $json->matches;
    date_default_timezone_set("Europe/London");
    $now = time();
    $nowDate = date("Y-m-d H:i:s");

    foreach($matches as $match)
    {
      $gameID = (int)$match->id;
      $stage = (string)$match->stage;
      $played = (string)$match->status;
      $duration = (string)$match->score->duration;

      $homeTeam = (string)($match->homeTeam->name) ? $match->homeTeam->name : "?";
      $awayTeam = (string)($match->awayTeam->name) ? $match->awayTeam->name : "?";

      $homeTLA = (string)($match->homeTeam->tla) ? $match->homeTeam->tla : "?";
      $awayTLA = (string)($match->awayTeam->tla) ? $match->awayTeam->tla : "?";

      $scoreFullHome = (int)($match->score->fullTime->home) ? $match->score->fullTime->home : 0;
      $scoreFullAway = (int)($match->score->fullTime->away) ? $match->score->fullTime->away : 0;

      $scoreRegularHome = 0;
      $scoreRegularAway = 0;

      if(isset($match->score->regularTime))
      {
        $scoreRegularHome = (int)($match->score->regularTime->home) ? $match->score->regularTime->home : 0;
        $scoreRegularAway = (int)($match->score->regularTime->away) ? $match->score->regularTime->away : 0;
      }

      $scoreExtraHome = 0;
      $scoreExtraAway = 0;

      if(isset($match->score->extraTime))
      {
        $scoreExtraHome = (int)($match->score->extraTime->home) ? $match->score->extraTime->home : 0;
        $scoreExtraAway = (int)($match->score->extraTime->away) ? $match->score->extraTime->away : 0;
      }

      $homeScore = $scoreFullHome;
      $awayScore = $scoreFullAway;

      if($duration === "PENALTY_SHOOTOUT")
      {
        $homeScore = $scoreRegularHome + $scoreExtraHome;
        $awayScore = $scoreRegularAway + $scoreExtraAway;
      }

      $unix = (int)strtotime($match->utcDate);
      $gmDate = date("d-M-Y H:i:s", $unix);

      $winner = (string)($match->score->winner) ? $match->score->winner : "?";

      DB::table('wc2022_results')->upsert(
        [
          [ 'gameID' => $gameID,
            'stage' => $stage,

            'homeTeam' => $homeTeam,
            'homeTLA' => $homeTLA,
            'homeScore' => $homeScore,

            'awayTeam' => $awayTeam,
            'awayTLA' => $awayTLA,
            'awayScore' => $awayScore,

            'kickoff' => $unix,
            'winner' => $winner,
            'played' => $played,

            'created_at' => $nowDate,
            'updated_at' => $nowDate
          ]
        ],
        [ 'gameID' ],
        [ 'stage', 'homeTeam', 'awayTeam', 'homeTLA', 'awayTLA', 'homeScore', 'awayScore', 'kickoff', 'winner', 'updated_at', 'played' ]
      );
    }
  }

  public function GetResults()
  {
    $results = DB::table('wc2022_results')
    ->orderBy('kickoff', 'asc')
    ->get();

    return $results;
  }

  public function GetAllPicks()
  {
    $picks = DB::table('wc2022_picks')
    ->get();

    return $picks;
  }

  public function GetUserPicks()
  {
    $id = Auth::user()->id;
    $picks = DB::table('wc2022_picks')
    ->where('userID', '=', $id)
    ->orderBy('userID', 'asc')
    ->get();

    return $picks;
  }

  public function SaveUserScores($games, $results)
  {
    $rLen = count($results);
    date_default_timezone_set("Europe/London");
    $now = time();
    $nowDate = date("Y-m-d H:i:s");
    $userID = Auth::user()->id;

    $len = count($games);
    for($i = 0; $i < $len; $i++)
    {
      $game = (array)$games[$i];
      // get game id
      $gameID = (int)$game[0];
      if(!is_numeric($gameID)) continue;
      
      // check that game hasn't already started
      $kickoff = $now;
      for($r = 0; $r < $rLen; $r++)
      {
        if($gameID === $results[$r]->gameID)
        {
          $kickoff = $results[$r]->kickoff;
          break;
        }
      }
      if($kickoff < $now) continue;

      // VALIDATE DATA
      $homeScore = (int)$game[1];
      if($homeScore < 0) $homeScore = 0;
      if($homeScore > 20) $homeScore = 20;

      $awayScore = (int)$game[2];
      if($awayScore < 0) $awayScore = 0;
      if($awayScore > 20) $awayScore = 20;

      $winner = (string)$game[3];
      if($winner === "A" || $winner === "B" || $winner === "D")
      {

      }
      else
      {
        $winner === "A";
      }

      if($homeScore > $awayScore) $winner = "A";
      if($awayScore > $homeScore) $winner = "B";
      
      $uniquePickId = "g" . $gameID . "u" . $userID;

      DB::table('wc2022_picks')->upsert(
        [
          [ 'uniquePickId' => $uniquePickId,
            'userID' => $userID,
            'gameID' => $gameID,

            'homeScore' => $homeScore,
            'awayScore' => $awayScore,
            'winner' => $winner,

            'created_at' => $nowDate,
            'updated_at' => $nowDate
          ]
        ],
        [ 'uniquePickId' ],
        [ 'homeScore', 'awayScore', 'winner', 'updated_at' ]
      );
    }
  }

  public function UpdateScores()
  {
    $results = $this->GetResults();
    $picks = $this->GetAllPicks();

    $playerScores = [];

    $resultCount = count($results);
    $pickCount = count($picks);

    for($i = 0; $i < $resultCount; $i++)
    {
      if($results[$i]->ignore === "YES") continue;
      if($results[$i]->played === "FINISHED" || $results[$i]->played === "IN_PLAY" || $results[$i]->played === "PAUSED")
      {
        for($p = 0; $p < $pickCount; $p++)
        {
          if($picks[$p]->gameID === $results[$i]->gameID)
          {
            $userID = $picks[$p]->userID;

            if(array_key_exists($userID, $playerScores))
            {
              $multipler = 1;

              if($results[$i]->stage === "LAST_16")
              {
                $multipler = 2;
              }
              else if($results[$i]->stage === "QUARTER_FINALS")
              {
                $multipler = 3;
              }
              else if($results[$i]->stage === "SEMI_FINALS")
              {
                $multipler = 5;
              }
              else if($results[$i]->stage === "FINAL")
              {
                $multipler = 8;
              }


              $bonus = true;

              // WINNER POINTS

              if( ($picks[$p]->winner === "A" && $results[$i]->winner === "HOME_TEAM" ) ||
                  ($picks[$p]->winner === "B" && $results[$i]->winner === "AWAY_TEAM" ) ||
                  ($picks[$p]->winner === "D" && $results[$i]->winner === "DRAW" )
              )
              {
                $playerScores[$userID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['gameWinner'] = $picks[$p]->winner;
              }
              else
              {
                $bonus = false;
                $playerScores[$userID]['games'][$results[$i]->gameID]['gameWinner'] = $picks[$p]->winner;
              }

              // A POINTS

              $aDif = abs($picks[$p]->homeScore - $results[$i]->homeScore);

              if($aDif === 0)
              {
                $playerScores[$userID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);
                // hello
                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($aDif === 1)
              {
                $playerScores[$userID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($aDif === 2)
              {
                $playerScores[$userID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // B POINTS

              $bDif = abs($picks[$p]->awayScore - $results[$i]->awayScore);

              if($bDif === 0)
              {
                $playerScores[$userID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($bDif === 1)
              {
                $playerScores[$userID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($bDif === 2)
              {
                $playerScores[$userID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // BONUS

              if($bonus)
              {
                $playerScores[$userID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
              }
            }
            else
            {
              $playerScores[$userID]['winnerPoints'] = 0;
              $playerScores[$userID]['aPoints'] = 0;
              $playerScores[$userID]['bPoints'] = 0;
              $playerScores[$userID]['bonusPoints'] = 0;
              $playerScores[$userID]['totalPoints'] = 0;
              $playerScores[$userID]['userID'] = $userID;

              for($u = 0; $u < $resultCount; $u++)
              {
                if($results[$u]->ignore === "YES") continue;
                if($results[$u]->played === "FINISHED" || $results[$u]->played === "IN_PLAY" || $results[$u]->played === "PAUSED")
                {
                  $playerScores[$userID]['games'][$results[$u]->gameID]['homeTeam'] = $results[$u]->homeTeam;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['awayTeam'] = $results[$u]->awayTeam;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['homeTLA'] = $results[$u]->homeTLA;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['awayTLA'] = $results[$u]->awayTLA;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['homeFinal'] = $results[$u]->homeScore;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['awayFinal'] = $results[$u]->awayScore;
                  $playerScores[$userID]['games'][$results[$i]->gameID]['homeScore'] = "n/a";
                  $playerScores[$userID]['games'][$results[$i]->gameID]['awayScore'] = "n/a";
                  $playerScores[$userID]['games'][$results[$u]->gameID]['winnerPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['aPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['bPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['bonusPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['totalPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['picked'] = false;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['gameWinner'] = "";
                }
              }

              $multipler = 1;

              if($results[$i]->stage === "LAST_16")
              {
                $multipler = 2;
              }
              else if($results[$i]->stage === "QUARTER_FINALS")
              {
                $multipler = 3;
              }
              else if($results[$i]->stage === "SEMI_FINALS")
              {
                $multipler = 5;
              }
              else if($results[$i]->stage === "FINAL")
              {
                $multipler = 8;
              }

              $bonus = true;

              // WINNER POINTS

              if( ($picks[$p]->winner === "A" && $results[$i]->winner === "HOME_TEAM" ) ||
                  ($picks[$p]->winner === "B" && $results[$i]->winner === "AWAY_TEAM" ) ||
                  ($picks[$p]->winner === "D" && $results[$i]->winner === "DRAW" )
              )
              {
                $playerScores[$userID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['gameWinner'] = $picks[$p]->winner;
              }
              else
              {
                $bonus = false;
                $playerScores[$userID]['games'][$results[$i]->gameID]['gameWinner'] = $picks[$p]->winner;
              }

              // A POINTS

              $aDif = abs($picks[$p]->homeScore - $results[$i]->homeScore);

              if($aDif === 0)
              {
                $playerScores[$userID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($aDif === 1)
              {
                $playerScores[$userID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($aDif === 2)
              {
                $playerScores[$userID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // B POINTS

              $bDif = abs($picks[$p]->awayScore - $results[$i]->awayScore);

              if($bDif === 0)
              {
                $playerScores[$userID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($bDif === 1)
              {
                $playerScores[$userID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($bDif === 2)
              {
                $playerScores[$userID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // BONUS

              if($bonus)
              {
                $playerScores[$userID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
              }
            }

            $playerScores[$userID]['games'][$results[$i]->gameID]['picked'] = true;
            $playerScores[$userID]['games'][$results[$i]->gameID]['homeScore'] = $picks[$p]->homeScore;
            $playerScores[$userID]['games'][$results[$i]->gameID]['awayScore'] = $picks[$p]->awayScore;
          }
        }
      }
    }
    return $playerScores;
  }

  public function SaveScores($playerScores)
  {
    date_default_timezone_set("Europe/London");
    $now = time();
    $nowDate = date("Y-m-d H:i:s");

    $len = count($playerScores);

    foreach($playerScores as $player)
    {
      $userID = (int)$player['userID'];
      $winnerPoints = (double)$player['winnerPoints'];
      $aPoints = (double)$player['aPoints'];
      $bPoints = (double)$player['bPoints'];
      $bonusPoints = (double)$player['bonusPoints'];
      $totalPoints = (double)$player['totalPoints'];

      DB::table('wc2022_players')->upsert(
        [
          [ 'userID' => $userID,
            'winnerPoints' => $winnerPoints,
            'homePoints' => $aPoints,

            'awayPoints' => $bPoints,
            'bonusPoints' => $bonusPoints,
            'totalPoints' => $totalPoints,
            'stake' => 0,
            'rank' => 0,
            'picksMade' => 0,
            'currentWinnings' => 0,

            'created_at' => $nowDate,
            'updated_at' => $nowDate
          ]
        ],
        [ 'userID' ],
        [ 'winnerPoints', 'homePoints', 'awayPoints', 'bonusPoints', 'totalPoints', 'updated_at' ]
      );
    }
  }

  public function RankPlayers()
  {
    $players = DB::table('wc2022_players')
    ->orderBy('totalPoints', 'desc')
    ->get();

    $count = count($players);
    $nowDate = date("Y-m-d H:i:s");

    if($count === 0) return;

    for($i = 0; $i < $count; $i++)
    {

      $userID = $players[$i]->userID;

      DB::table('wc2022_players')
      ->where('userID', "=", $userID)
      ->update(['rank' => ($i + 1),
                'updated_at' => $nowDate ]);
    }
  }

  public function GetAllPlayers()
  {
    $players = DB::table('wc2022_players')
    ->join('users', 'users.id', '=', 'wc2022_players.userID')
    ->orderBy('rank', 'asc')
    ->get();

    return $players;
  }

  public function CalculateWinnings()
  {
    $players = $this->GetAllPlayers();

    $count = count($players);

    $tempStakes = [];
    for($i = 0; $i < $count; $i++)
    {
      $tempStakes[$i]['userID'] = $players[$i]->userID;
      $tempStakes[$i]['rank'] = $players[$i]->rank;
      $tempStakes[$i]['stake'] = $players[$i]->stake;
      $tempStakes[$i]['currentWinnings'] = 0;
    }

    if($count !== count($tempStakes)) return;

    // i = ranked player accruing winnings
    // p = player feeding the winnings and losing stake

    for($i = 0; $i < $count; $i++)
    {
      $stake = $tempStakes[$i]['stake'];
      if($stake === 0) continue;

      for($p = 0; $p < $count; $p++)
      {
        $donation = $tempStakes[$p]['stake'];
        if($donation === 0) continue;

        if($tempStakes[$i]['userID'] === $tempStakes[$p]['userID'])
        {
          $tempStakes[$i]['currentWinnings'] += $donation;
          $tempStakes[$i]['stake'] -= $donation;
          continue;
        }

        if($donation >= $stake)
        {
          $tempStakes[$i]['currentWinnings'] += $stake;
          $tempStakes[$p]['stake'] -= $stake;
        }
        else
        {
          $tempStakes[$i]['currentWinnings'] += $donation;
          $tempStakes[$p]['stake'] -= $donation;
        }
      }
    }

    $nowDate = date("Y-m-d H:i:s");

    for($i = 0; $i < $count; $i++)
    {
      $userID = $tempStakes[$i]['userID'];
      DB::table('wc2022_players')
      ->where('userID', "=", $userID)
      ->update(['currentWinnings' => $tempStakes[$i]['currentWinnings'],
                'updated_at' => $nowDate ]);
    }

    return $tempStakes;
  }

  public function UpdateStake($newStake, $userID)
  {
    $nowDate = date("Y-m-d H:i:s");

    DB::table('wc2022_players')
    ->where('userID', "=", $userID)
    ->update(['stake' => $newStake,
              'updated_at' => $nowDate ]);
  }

  public function GetCSV($playerID)
  {
    $results = $this->GetResults();
    $picks = $this->GetAllPicks();

    $playerScores = [];

    $resultCount = count($results);
    $pickCount = count($picks);

    for($i = 0; $i < $resultCount; $i++)
    {
      if($results[$i]->ignore === "YES") continue;
      if($results[$i]->played === "FINISHED" || $results[$i]->played === "IN_PLAY" || $results[$i]->played === "PAUSED")
      {
        for($p = 0; $p < $pickCount; $p++)
        {
          if($picks[$p]->userID != $playerID) continue;
          if($picks[$p]->gameID === $results[$i]->gameID)
          {
            $userID = $picks[$p]->userID;

            if(array_key_exists($userID, $playerScores))
            {
              $multipler = 1;

              if($results[$i]->stage === "LAST_16")
              {
                $multipler = 2;
              }
              else if($results[$i]->stage === "QUARTER_FINALS")
              {
                $multipler = 3;
              }
              else if($results[$i]->stage === "SEMI_FINALS")
              {
                $multipler = 5;
              }
              else if($results[$i]->stage === "FINAL")
              {
                $multipler = 8;
              }


              $bonus = true;

              // WINNER POINTS

              if( ($picks[$p]->winner === "A" && $results[$i]->winner === "HOME_TEAM" ) ||
                  ($picks[$p]->winner === "B" && $results[$i]->winner === "AWAY_TEAM" ) ||
                  ($picks[$p]->winner === "D" && $results[$i]->winner === "DRAW" )
              )
              {
                $playerScores[$userID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
              }
              else
              {
                $bonus = false;
              }

              // A POINTS

              $aDif = abs($picks[$p]->homeScore - $results[$i]->homeScore);

              if($aDif === 0)
              {
                $playerScores[$userID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);
                // hello
                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($aDif === 1)
              {
                $playerScores[$userID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($aDif === 2)
              {
                $playerScores[$userID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // B POINTS

              $bDif = abs($picks[$p]->awayScore - $results[$i]->awayScore);

              if($bDif === 0)
              {
                $playerScores[$userID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($bDif === 1)
              {
                $playerScores[$userID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($bDif === 2)
              {
                $playerScores[$userID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // BONUS

              if($bonus)
              {
                $playerScores[$userID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
              }
            }
            else
            {
              $playerScores[$userID]['winnerPoints'] = 0;
              $playerScores[$userID]['aPoints'] = 0;
              $playerScores[$userID]['bPoints'] = 0;
              $playerScores[$userID]['bonusPoints'] = 0;
              $playerScores[$userID]['totalPoints'] = 0;
              $playerScores[$userID]['userID'] = $userID;

              for($u = 0; $u < $resultCount; $u++)
              {
                if($results[$u]->ignore === "YES") continue;
                if($results[$u]->played === "FINISHED" || $results[$u]->played === "IN_PLAY" || $results[$u]->played === "PAUSED")
                {
                  $playerScores[$userID]['games'][0]['stage'] = "Stage";
                  $playerScores[$userID]['games'][0]['homeTeam'] = "Team A";
                  $playerScores[$userID]['games'][0]['awayTeam'] = "Team B";
                  $playerScores[$userID]['games'][0]['homeFinal'] = "Final A Score";
                  $playerScores[$userID]['games'][0]['awayFinal'] = "Final B Score";
                  $playerScores[$userID]['games'][0]['homeScore'] = "A Prediction";
                  $playerScores[$userID]['games'][0]['awayScore'] = "B Prediction";
                  $playerScores[$userID]['games'][0]['winner'] = "Predicted Winner";
                  $playerScores[$userID]['games'][0]['winnerPoints'] = "Winner Points";
                  $playerScores[$userID]['games'][0]['aPoints'] = "A Points";
                  $playerScores[$userID]['games'][0]['bPoints'] = "B Points";
                  $playerScores[$userID]['games'][0]['bonusPoints'] = "Bonus Points";
                  $playerScores[$userID]['games'][0]['totalPoints'] = "Total Points";
                  $playerScores[$userID]['games'][0]['kickoff'] = 0;
                  $playerScores[$userID]['games'][0]['actualWinner'] = "Actual Winner";

                  $playerScores[$userID]['games'][$results[$u]->gameID]['homeTeam'] = $results[$u]->homeTeam;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['awayTeam'] = $results[$u]->awayTeam;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['homeFinal'] = $results[$u]->homeScore;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['awayFinal'] = $results[$u]->awayScore;
                  $playerScores[$userID]['games'][$results[$i]->gameID]['homeScore'] = "n/a";
                  $playerScores[$userID]['games'][$results[$i]->gameID]['awayScore'] = "n/a";
                  $playerScores[$userID]['games'][$results[$u]->gameID]['winnerPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['aPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['bPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['bonusPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['totalPoints'] = 0;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['stage'] = $results[$u]->stage;
                  $playerScores[$userID]['games'][$results[$u]->gameID]['kickoff'] = $results[$u]->kickoff;
                  if($results[$u]->winner === "HOME_TEAM") $playerScores[$userID]['games'][$results[$u]->gameID]['actualWinner'] = "A";
                  if($results[$u]->winner === "AWAY_TEAM") $playerScores[$userID]['games'][$results[$u]->gameID]['actualWinner'] = "B";
                  if($results[$u]->winner === "DRAW") $playerScores[$userID]['games'][$results[$u]->gameID]['actualWinner'] = "D";
                }
              }

              $multipler = 1;

              if($results[$i]->stage === "LAST_16")
              {
                $multipler = 2;
              }
              else if($results[$i]->stage === "QUARTER_FINALS")
              {
                $multipler = 3;
              }
              else if($results[$i]->stage === "SEMI_FINALS")
              {
                $multipler = 5;
              }
              else if($results[$i]->stage === "FINAL")
              {
                $multipler = 8;
              }

              $bonus = true;

              // WINNER POINTS

              if( ($picks[$p]->winner === "A" && $results[$i]->winner === "HOME_TEAM" ) ||
                  ($picks[$p]->winner === "B" && $results[$i]->winner === "AWAY_TEAM" ) ||
                  ($picks[$p]->winner === "D" && $results[$i]->winner === "DRAW" )
              )
              {
                $playerScores[$userID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['winnerPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
              }
              else
              {
                $bonus = false;
              }

              // A POINTS

              $aDif = abs($picks[$p]->homeScore - $results[$i]->homeScore);

              if($aDif === 0)
              {
                $playerScores[$userID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($aDif === 1)
              {
                $playerScores[$userID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($aDif === 2)
              {
                $playerScores[$userID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['aPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // B POINTS

              $bDif = abs($picks[$p]->awayScore - $results[$i]->awayScore);

              if($bDif === 0)
              {
                $playerScores[$userID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['totalPoints'] += (3 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (3 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (3 * $multipler);
              }
              else if($bDif === 1)
              {
                $playerScores[$userID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['totalPoints'] += (2 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (2 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (2 * $multipler);

                $bonus = false;
              }
              else if($bDif === 2)
              {
                $playerScores[$userID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['totalPoints'] += (1 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bPoints'] += (1 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (1 * $multipler);

                $bonus = false;
              }
              else
              {
                $bonus = false;
              }

              // BONUS

              if($bonus)
              {
                $playerScores[$userID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['totalPoints'] += (4 * $multipler);

                $playerScores[$userID]['games'][$results[$i]->gameID]['bonusPoints'] += (4 * $multipler);
                $playerScores[$userID]['games'][$results[$i]->gameID]['totalPoints'] += (4 * $multipler);
              }
            }

            $playerScores[$userID]['games'][$results[$i]->gameID]['homeScore'] = $picks[$p]->homeScore;
            $playerScores[$userID]['games'][$results[$i]->gameID]['awayScore'] = $picks[$p]->awayScore;
            $playerScores[$userID]['games'][$results[$i]->gameID]['winner'] = $picks[$p]->winner;
          }
        }
      }
    }
    return $playerScores[$playerID]['games'];
  }
}