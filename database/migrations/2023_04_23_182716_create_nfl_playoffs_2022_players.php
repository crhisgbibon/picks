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
      Schema::create('nfl_playoffs_2022_players', function (Blueprint $table) {
        $table->id()->autoIncrement();

        $table->integer('userID');
        $table->integer('rank');

        $table->string('created_at', 45);
        $table->string('updated_at', 45);

        $table->integer('buffer');
        $table->integer('spread');
        $table->integer('stake');
        $table->integer('currentWinnings');
        $table->integer('difference');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('nfl_playoffs_2022_players');
    }
};
