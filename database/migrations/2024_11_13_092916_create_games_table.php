<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_1')->constrained('teams')->onDelete('cascade');
            $table->foreignId('team_2')->constrained('teams')->onDelete('cascade');
            $table->unsignedInteger('team_1_score')->default(0);
            $table->unsignedInteger('team_2_score')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};
