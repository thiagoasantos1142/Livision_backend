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
       Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->year('year_launched')->nullable();
            $table->enum('type', ['movie', 'series', 'episode', 'live_event', 'recorded_event']);
            $table->enum('rating', ['L', '10', '12', '14', '16', '18'])->default('L');
            $table->integer('duration')->nullable(); // em minutos
            $table->boolean('is_open')->default(false); // gratuito ou não
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
