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
      Schema::create('wc2022_results', function (Blueprint $table) {
        $table->id()->autoIncrement();

        $table->integer('gameID');

        $table->string('stage', 255);

        $table->string('homeTeam', 255);
        $table->string('homeTLA', 255);
        $table->integer('homeScore');

        $table->string('awayTeam', 255);
        $table->string('awayTLA', 255);
        $table->integer('awayScore');

        $table->integer('kickoff');

        $table->string('winner', 255);
        $table->string('played', 255);

        $table->timestamps();
        $table->string('ignore', 45);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('wc2022_results');
    }
};
