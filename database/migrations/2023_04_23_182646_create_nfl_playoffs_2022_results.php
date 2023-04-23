<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('nfl_playoffs_2022_results', function (Blueprint $table) {
        $table->id()->autoIncrement();

        $table->integer('gameID');

        $table->string('conference', 45);
        $table->string('stage', 45);

        $table->string('homeTeam', 45);
        $table->string('homeTLA', 45);
        $table->integer('homeScore');

        $table->string('awayTeam', 45);
        $table->string('awayTLA', 45);
        $table->integer('awayScore');

        $table->integer('kickoff');

        $table->string('winner', 45);
        $table->string('played', 45);

        $table->integer('created_at');
        $table->integer('updated_at');
        $table->string('ignore', 45);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('nfl_playoffs_2022_results');
    }
};
