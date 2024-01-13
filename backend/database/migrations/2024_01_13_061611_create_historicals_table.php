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
        Schema::create('historicals', function (Blueprint $table) {
            $table->unsignedBigInteger('championship_id');
            $table->foreign('championship_id')->references('id')->on('championships')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('1st_place_team_id')->nullable(false);
            $table->integer('2st_place_team_id')->nullable(false);
            $table->integer('3st_place_team_id')->nullable(false);
            $table->integer('4st_place_team_id')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historicals');
    }
};
