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
        Schema::create('video_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->string('disk')->default('s3');

            $table->enum('quality', ['360p', '480p', '720p', '1080p', '4k', '8k']);
            $table->string('mime_type')->nullable();
            $table->unsignedInteger('size')->comment('Tamanho em bytes');
            $table->enum('status', ['processing', 'ready', 'failed'])->default('processing');
            $table->timestamps();
            
            $table->index('video_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_files');
    }
};
