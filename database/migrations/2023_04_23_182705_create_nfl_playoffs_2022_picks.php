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
      Schema::create('nfl_playoffs_2022_picks', function (Blueprint $table) {
        $table->id()->autoIncrement();

        $table->string('uniquePicked', 255);
        $table->integer('userID');
        $table->integer('gameID');

        $table->integer('homeScore');
        $table->integer('awayScore');

        $table->string('winner', 255);
        $table->string('created_at', 45);
        $table->string('updated_at', 45);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('nfl_playoffs_2022_picks');
    }
};
