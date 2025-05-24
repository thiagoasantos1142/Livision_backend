<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->foreignId('season_id')
                  ->nullable()
                  ->constrained('seasons')
                  ->onDelete('set null');
                  
            $table->integer('episode_number')
                  ->nullable()
                  ->comment('Número do episódio para séries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            //
        });
    }
};
