<?php

namespace App\Models\NFL_Playoffs_2022;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ModelNFL_Playoffs_2022 extends Model
{
  use HasFactory;

  protected $table = "nfl_playoffs_2022_results";
  
  public function FillData()
  {
    date_default_timezone_set('US/Eastern');
    $nowDate = strtotime("now");
    $data = [
      [ 
        // WILDCARD 1
        'gameID' => 0,
        'conference' => "NFL",
        'stage' => "WILDCARD",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-14 16:30:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // WILDCARD 2
        'gameID' => 1,
        'conference' => "NFL",
        'stage' => "WILDCARD",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-15 20:15:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // WILDCARD 3
        'gameID' => 2,
        'conference' => "NFL",
        'stage' => "WILDCARD",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-15 13:00:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // WILDCARD 4
        'gameID' => 3,
        'conference' => "NFL",
        'stage' => "WILDCARD",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-15 16:30:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // WILDCARD 5
        'gameID' => 4,
        'conference' => "NFL",
        'stage' => "WILDCARD",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-15 20:15:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // WILDCARD 6
        'gameID' => 5,
        'conference' => "NFL",
        'stage' => "WILDCARD",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-16 20:00:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // DIVISIONAL 1
        'gameID' => 6,
        'conference' => "NFL",
        'stage' => "DIVISIONAL",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-21 16:30:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // DIVISIONAL 2
        'gameID' => 7,
        'conference' => "NFL",
        'stage' => "DIVISIONAL",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-21 20:15:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // DIVISIONAL 3
        'gameID' => 8,
        'conference' => "NFL",
        'stage' => "DIVISIONAL",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-22 15:00:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // DIVISIONAL 4
        'gameID' => 9,
        'conference' => "NFL",
        'stage' => "DIVISIONAL",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-22 18:30:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // CHAMPIONSHIP 1
        'gameID' => 10,
        'conference' => "NFL",
        'stage' => "CHAMPIONSHIP",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-29 15:00:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // CHAMPIONSHIP 2
        'gameID' => 11,
        'conference' => "NFL",
        'stage' => "CHAMPIONSHIP",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-01-29 18:30:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ],
      [ 
        // SUPERBOWL
        'gameID' => 12,
        'conference' => "NFL",
        'stage' => "SUPERBOWL",
  
        'homeTeam' => "?",
        'homeTLA' => "?",
        'homeScore' => 0,
  
        'awayTeam' => "?",
        'awayTLA' => "?",
        'awayScore' => 0,
  
        'kickoff' => strtotime("2023-02-12 18:30:00"),
        'winner' => "?",
        'played' => "NO",
  
        'created_at' => $nowDate,
        'updated_at' => $nowDate,

        'ignore' => "NO"
      ]
    ];

    DB::table("nfl_playoffs_2022_results")->upsert(
      $data,
      [ 'gameID' ],
      [ 'conference', 'stage', 'homeTeam', 'awayTeam', 'homeTLA', 'awayTLA', 'homeScore', 'awayScore', 'kickoff', 'winner', 'played', 'updated_at', 'ignore' ]
    );
  }

  public function GetResults()
  {
    $results = DB::table("nfl_playoffs_2022_results")
    ->orderBy('kickoff', 'asc')
    ->get();
    return $results;
  }

  public function GetUserPicks()
  {
    $id = Auth::user()->id;
    $picks = DB::table("nfl_playoffs_2022_picks")
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

      $stage = (string)$game[1];

      if($stage === "SUPERBOWL")
      {
        // VALIDATE DATA
        $homeScore = (int)$game[2];
        if($homeScore < 0) $homeScore = 0;
        if(!is_numeric($homeScore)) continue;

        $awayScore = (int)$game[3];
        if($awayScore < 0) $awayScore = 0;
        if(!is_numeric($awayScore)) continue;
      }
      else
      {
        // VALIDATE DATA
        $gameWinner = (string)$game[2];

        if($gameWinner === "true")
        {
          $homeScore = 1;
          $awayScore = 0;
        }
        else
        {
          $homeScore = 0;
          $awayScore = 1;
        }
      }
      
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
      
      $uniquePickId = "g" . $gameID . "u" . $userID;

      DB::table("nfl_playoffs_2022_picks")->upsert(
        [
          [ 'uniquePickId' => $uniquePickId,
            'userID' => $userID,
            'gameID' => $gameID,

            'homeScore' => $homeScore,
            'awayScore' => $awayScore,

            'created_at' => $nowDate,
            'updated_at' => $nowDate
          ]
        ],
        [ 'uniquePickId' ],
        [ 'homeScore', 'awayScore', 'winner', 'updated_at' ]
      );
    }
  }

  public function GetAllPicks()
  {
    $picks = DB::table("nfl_playoffs_2022_picks")
    ->get();

    return $picks;
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
        for($p = 0; $p < $pickCount; $p++)
        {
          if($picks[$p]->gameID === $results[$i]->gameID)
          {
            $userID = $picks[$p]->userID;

            if(array_key_exists($userID, $playerScores))
            {
              if($results[$i]->stage === "SUPERBOWL")
              {
                $pointsPerPick = 8;

                if($results[$i]->played === "YES")
                {
                  if( ( $picks[$p]->homeScore > $picks[$p]->awayScore && $results[$i]->homeScore > $results[$i]->awayScore ) ||
                  ( $picks[$p]->homeScore < $picks[$p]->awayScore && $results[$i]->homeScore < $results[$i]->awayScore ) )
                  {
                    $playerScores[$userID]['buffer'] += $pointsPerPick;
                    $playerScores[$userID]['games'][$results[$i]->gameID]['buffer'] += $pointsPerPick;
                  }
                }

                $actualHomeScore = $results[$i]->homeScore;
                $actualAwayScore = $results[$i]->awayScore;

                $predictedHomeScore = $picks[$p]->homeScore;
                $predictedAwayScore = $picks[$p]->awayScore;

                $absHome = abs($actualHomeScore - $predictedHomeScore);
                $absAway = abs($actualAwayScore - $predictedAwayScore);

                $totalAbs = $absHome + $absAway;

                if($results[$i]->played === "YES")
                {
                  $playerScores[$userID]['abs'] += $totalAbs;

                  $spread = $totalAbs - $playerScores[$userID]['buffer'];

                  $playerScores[$userID]['spread'] = -$spread;
                }

              }
              else
              {
                $pointsPerPick = 1;

                if($results[$i]->stage === "DIVISIONAL")
                {
                  $pointsPerPick = 2;
                }
                else if($results[$i]->stage === "CHAMPIONSHIP")
                {
                  $pointsPerPick = 4;
                }
                else if($results[$i]->stage === "SUPERBOWL")
                {
                  $pointsPerPick = 8;
                }

                if($results[$i]->played === "YES")
                {
                  if( ( $picks[$p]->homeScore > $picks[$p]->awayScore && $results[$i]->homeScore > $results[$i]->awayScore ) ||
                  ( $picks[$p]->homeScore < $picks[$p]->awayScore && $results[$i]->homeScore < $results[$i]->awayScore ) )
                  {
                    $playerScores[$userID]['buffer'] += $pointsPerPick;
                    $playerScores[$userID]['games'][$results[$i]->gameID]['buffer'] += $pointsPerPick;
                  }
                }
              }
            }
            else
            {
              $playerScores[$userID]['buffer'] = 0;
              $playerScores[$userID]['abs'] = 0;
              $playerScores[$userID]['spread'] = 0;
              $playerScores[$userID]['userID'] = $userID;

              for($u = 0; $u < $resultCount; $u++)
              {
                if($results[$u]->ignore === "YES") continue;
                $playerScores[$userID]['games'][$results[$u]->gameID]['stage'] = $results[$u]->stage;
                $playerScores[$userID]['games'][$results[$u]->gameID]['homeTeam'] = $results[$u]->homeTeam;
                $playerScores[$userID]['games'][$results[$u]->gameID]['awayTeam'] = $results[$u]->awayTeam;
                $playerScores[$userID]['games'][$results[$u]->gameID]['homeTLA'] = $results[$u]->homeTLA;
                $playerScores[$userID]['games'][$results[$u]->gameID]['awayTLA'] = $results[$u]->awayTLA;
                $playerScores[$userID]['games'][$results[$u]->gameID]['homeFinal'] = $results[$u]->homeScore;
                $playerScores[$userID]['games'][$results[$u]->gameID]['awayFinal'] = $results[$u]->awayScore;
                $playerScores[$userID]['games'][$results[$i]->gameID]['homeScore'] = 0;
                $playerScores[$userID]['games'][$results[$i]->gameID]['awayScore'] = 0;
                $playerScores[$userID]['games'][$results[$u]->gameID]['buffer'] = 0;
                $playerScores[$userID]['games'][$results[$u]->gameID]['abs'] = 0;
                $playerScores[$userID]['games'][$results[$u]->gameID]['spread'] = 0;
                $playerScores[$userID]['games'][$results[$u]->gameID]['picked'] = false;
              }

              if($results[$i]->stage === "SUPERBOWL" && $results[$i]->played === "YES")
              {
                $actualHomeScore = $results[$i]->homeScore;
                $actualAwayScore = $results[$i]->awayScore;

                $predictedHomeScore = $picks[$p]->homeScore;
                $predictedAwayScore = $picks[$p]->awayScore;

                $absHome = abs($actualHomeScore - $predictedHomeScore);
                $absAway = abs($actualAwayScore - $predictedAwayScore);

                $totalAbs = $absHome + $absAway;

                if($results[$i]->played === "YES")
                {
                  $playerScores[$userID]['abs'] += $totalAbs;

                  $spread = $totalAbs - $playerScores[$userID]['buffer'];

                  $playerScores[$userID]['spread'] = -$spread;
                }

              }
              else
              {
                $pointsPerPick = 1;

                if($results[$i]->stage === "DIVISIONAL")
                {
                  $pointsPerPick = 2;
                }
                else if($results[$i]->stage === "CHAMPIONSHIP")
                {
                  $pointsPerPick = 4;
                }

                if($results[$i]->played === "YES")
                {
                  if( ( $picks[$p]->homeScore > $picks[$p]->awayScore && $results[$i]->homeScore > $results[$i]->awayScore ) ||
                  ( $picks[$p]->homeScore < $picks[$p]->awayScore && $results[$i]->homeScore < $results[$i]->awayScore ) )
                  {
                    $playerScores[$userID]['buffer'] += $pointsPerPick;
                    $playerScores[$userID]['games'][$results[$i]->gameID]['buffer'] += $pointsPerPick;
                  }
                }
              }
            }

            if($results[$i]->played === "YES")
            {
              $playerScores[$userID]['games'][$results[$i]->gameID]['played'] = "YES";
            }
            else
            {
              $playerScores[$userID]['games'][$results[$i]->gameID]['played'] = "NO";
            }

            $playerScores[$userID]['games'][$results[$i]->gameID]['picked'] = true;
            $playerScores[$userID]['games'][$results[$i]->gameID]['homeScore'] = $picks[$p]->homeScore;
            $playerScores[$userID]['games'][$results[$i]->gameID]['awayScore'] = $picks[$p]->awayScore;
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
      $buffer = (int)$player['buffer'];
      $dif = (int)$player['abs'];
      $spread = (int)$player['spread'];
      DB::table("nfl_playoffs_2022_players")->upsert(
        [
          [ 'userID' => $userID,
            'buffer' => $buffer,
            'difference' => $dif,
            'spread' => $spread,

            'stake' => 0,
            'rank' => 0,
            'currentWinnings' => 0,

            'created_at' => $nowDate,
            'updated_at' => $nowDate
          ]
        ],
        [ 'userID' ],
        [ 'buffer', 'spread', 'difference', 'updated_at' ]
      );
    }
  }

  public function ResetScores()
  {
    $players = $this->GetAllPlayers();
    date_default_timezone_set("Europe/London");
    $now = time();
    $nowDate = date("Y-m-d H:i:s");
    $len = count($players);
    foreach($players as $player)
    {
      $userID = $player->userID;
      DB::table("nfl_playoffs_2022_players")->upsert(
        [
          [ 'userID' => $userID,
            'buffer' => 0,
            'difference' => 0,
            'spread' => 0,

            'created_at' => $nowDate,
            'updated_at' => $nowDate
          ]
        ],
        [ 'userID' ],
        [ 'buffer', 'spread', 'difference', 'updated_at' ]
      );
    }
  }

  public function RankPlayers()
  {
    $results = $this->GetResults();
    $hasPlayedSuperBowl = false;
    foreach($results as $result)
    {
      if($result->stage === "SUPERBOWL" && $result->played === "YES") $hasPlayedSuperBowl = true;
    }
    if($hasPlayedSuperBowl)
    {
      $players = DB::table("nfl_playoffs_2022_players")
      ->orderBy('spread', 'desc')
      ->get();
    }
    else
    {
      $players = DB::table("nfl_playoffs_2022_players")
      ->orderBy('buffer', 'desc')
      ->get();
    }
    $count = count($players);
    $nowDate = date("Y-m-d H:i:s");
    if($count === 0) return;
    for($i = 0; $i < $count; $i++)
    {
      $userID = $players[$i]->userID;
      DB::table("nfl_playoffs_2022_players")
      ->where('userID', "=", $userID)
      ->update(['rank' => ($i + 1),
                'updated_at' => $nowDate ]);
    }
  }

  public function GetAllPlayers()
  {
    $players = DB::table("nfl_playoffs_2022_players")
    ->join('users', 'users.id', '=', 'nfl_playoffs_2022_players.userID')
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
      DB::table("nfl_playoffs_2022_players")
      ->where('userID', "=", $userID)
      ->update(['currentWinnings' => $tempStakes[$i]['currentWinnings'],
                'updated_at' => $nowDate ]);
    }

    return $tempStakes;
  }

  public function UpdateStake($newStake, $userID)
  {
    $nowDate = date("Y-m-d H:i:s");
    DB::table("nfl_playoffs_2022_players")
    ->where('userID', "=", $userID)
    ->update(['stake' => $newStake,
              'updated_at' => $nowDate ]);
  }

  public function GetNflTeams()
  {
    return $teams = DB::table("nfl_teams")
    ->orderBy('name', 'asc')
    ->get();
  }

  public function GetNflTeam($index)
  {
    $team = DB::table("nfl_teams")
    ->where('id', "=", (int)$index)
    ->first();
    return $team;
  }
}
