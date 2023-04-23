<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\ModelWC2022;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

      /* GAME OVER
      $schedule->call(function () {
        $model = new ModelWC2022();
        $model->Update_WC2022_Results();
        $playerScores = $model->UpdateScores();
        $model->SaveScores($playerScores);
        $model->RankPlayers();
        $model->CalculateWinnings();
      })->everyFiveMinutes();
      */
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
