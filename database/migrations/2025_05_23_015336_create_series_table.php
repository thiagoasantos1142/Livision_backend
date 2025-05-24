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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->year('year_launched')->nullable();
            $table->string('slug')->unique();
            $table->enum('rating', ['L', '10', '12', '14', '16', '18'])->default('L');
            $table->string('thumbnail_url')->nullable();
            $table->string('banner_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
