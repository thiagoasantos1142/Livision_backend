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
        Schema::create('camera_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camera_id')->constrained()->onDelete('cascade');
            $table->string('filename');
            $table->string('path');
            $table->integer('duration')->nullable();
            $table->timestamp('recorded_at')->nullable(); // ou "start_time"  
            $table->enum('quality', ['360p', '480p', '720p', '1080p', '4k', '8k']);
            $table->string('mime_type')->nullable();
            $table->unsignedInteger('size')->comment('Tamanho em bytes');
            $table->enum('status', ['processing', 'ready', 'failed'])->default('processing');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camera_videos');
    }
};
