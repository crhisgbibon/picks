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
      Schema::create('wc2022_players', function (Blueprint $table) {
        $table->id()->autoIncrement();

        $table->integer('userID');
        $table->double('stake', 8, 2);

        $table->double('winnerPoints', 8, 2);
        $table->double('homePoints', 8, 2);
        $table->double('awayPoints', 8, 2);
        $table->double('bonusPoints', 8, 2);
        $table->double('totalPoints', 8, 2);

        $table->integer('rank');
        $table->integer('picksMade');

        $table->double('currentWinnings', 8, 2);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('wc2022_players');
    }
};
