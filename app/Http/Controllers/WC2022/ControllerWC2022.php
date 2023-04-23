<?php

namespace App\Http\Controllers\WC2022;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\WC2022\ModelWC2022;

class ControllerWC2022 extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelWC2022();
    $results = $model->GetResults();
    $picks = $model->GetUserPicks();
    $now = time();

    return view('WC2022.wc2022input', [
      'results' => $results,
      'picks' => $picks,
      'now' => $now
    ]);
  }

  public function SaveScores(Request $request)
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelWC2022();
    $results = $model->GetResults();
    $debug = $model->SaveUserScores($request->games, $results);
    $picks = $model->GetUserPicks();
    $now = time();

    return view('WC2022.components.wc2022scores', [
      'results' => $results,
      'picks' => $picks,
      'now' => $now
    ]);
  }

  public function GetTable()
  {
    date_default_timezone_set("Europe/London");
    $model = new ModelWC2022();

    $playerScores = $model->UpdateScores();
    //return $playerScores;
    $model->SaveScores($playerScores);
    $model->RankPlayers();
    $model->CalculateWinnings();

    $players = $model->GetAllPlayers();

    return view('WC2022.wc2022table', [
      'players' => $players,
      'playerscores' => $playerScores
    ]);
  }

  public function GetCSV(Request $request)
  {
    $id = (int)$request->id;

    date_default_timezone_set("Europe/London");
    $model = new ModelWC2022();

    $list = $model->GetCSV($id);
    return $list;

    $headers = [
          'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
      ,   'Content-type'        => 'text/csv'
      ,   'Content-Disposition' => 'attachment; filename=galleries.csv'
      ,   'Expires'             => '0'
      ,   'Pragma'              => 'public'
    ];

    $callback = function() use ($list) 
    {
      $FH = fopen('php://output', 'w');
      foreach ($list as $row) { 
          fputcsv($FH, $row);
      }
      fclose($FH);
    };

    return response()->stream($callback, 200, $headers);

    // $this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
    // return $this->array2csv($array);
  }

  function download_send_headers($filename)
  {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
  }

  function array2csv(array &$array)
  {
    if (count($array) == 0) {
      return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($df, $row);
    }
    fclose($df);
    return ob_get_clean();
  }
}