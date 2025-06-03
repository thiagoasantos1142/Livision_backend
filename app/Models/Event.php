<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Camera;
use App\Models\CameraVideo;
use App\Models\CameraAudio;
use App\Models\CameraImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'type',
        'category',
        'start_time',
        'end_time',
        'is_open',
        'published',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_open' => 'boolean',
        'published' => 'boolean',
    ];

    // Um evento tem muitas câmeras
    public function cameras()
    {
        return $this->hasMany(Camera::class, 'event_id', 'id');
    }

    // Muitos para muitos com genres
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'event_genres', 'event_id', 'genre_id')->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Um evento pode ter muitos vídeos
    public function videos()
    {
        return $this->hasMany(CameraVideo::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos áudios
    public function audios()
    {
        return $this->hasMany(CameraAudio::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de imagem
    public function images()
    {
        return $this->hasMany(CameraImage::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de legenda
    public function subtitles()
    {
        return $this->hasMany(CameraSubtitle::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de transcrição
    public function transcriptions()
    {
        return $this->hasMany(CameraTranscription::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de anotações
    public function annotations()
    {
        return $this->hasMany(CameraAnnotation::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de metadados
    public function metadata()
    {
        return $this->hasMany(CameraMetadata::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de logs
    public function logs()
    {
        return $this->hasMany(CameraLog::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de relatórios
    public function reports()
    {
        return $this->hasMany(CameraReport::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de análises
    public function analyses()
    {
        return $this->hasMany(CameraAnalysis::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de backups
    public function backups()
    {
        return $this->hasMany(CameraBackup::class, 'event_id', 'id');
    }
    // Um evento pode ter muitos arquivos de sincronização
    public function synchronizations()
    {
        return $this->hasMany(CameraSynchronization::class, 'event_id', 'id');
    }

}
