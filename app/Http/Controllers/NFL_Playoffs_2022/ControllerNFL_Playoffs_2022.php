<?php

namespace App\Http\Controllers\NFL_Playoffs_2022;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\NFL_Playoffs_2022\ModelNFL_Playoffs_2022;

class ControllerNFL_Playoffs_2022 extends Controller
{
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelNFL_Playoffs_2022();
    $results = $model->GetResults();
    $picks = $model->GetUserPicks();
    $now = time();
    return view('NFL_Playoffs_2022.playoffs', [
      'results' => $results,
      'picks' => $picks,
      'now' => $now
    ]);
  }

  public function SaveScores(Request $request)
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelNFL_Playoffs_2022();
    $results = $model->GetResults();
    $debug = $model->SaveUserScores($request->games, $results);
    $picks = $model->GetUserPicks();
    $now = time();
    return view('components.NFL_Playoffs_2022.scores', [
      'results' => $results,
      'picks' => $picks,
      'now' => $now
    ]);
  }

  public function GetTable()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelNFL_Playoffs_2022();
    $playerScores = $model->UpdateScores();
    $model->SaveScores($playerScores);
    $model->RankPlayers();
    $model->CalculateWinnings();
    $players = $model->GetAllPlayers();
    return view('NFL_Playoffs_2022.playoffsTable', [
      'players' => $players,
      'playerscores' => $playerScores
    ]);
  }

  public function rules()
  {
    date_default_timezone_set("Europe/London");
    return view('NFL_Playoffs_2022.rules', [

    ]);
  }
}
