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
        'slug', 
        'description',
        'format',
        'event_type_id',
        'event_category_id',
        'start_time',
        'end_time',
        'is_open',
        'published',
        'location',
        'thumbnail',
        'general_info',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_open' => 'boolean',
        'published' => 'boolean',
    ];

 
    public function participants()
    {
        return $this->hasMany(EventParticipant::class)->with('participant');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
    public function cameras()
    {
        return $this->hasMany(Camera::class);
    }
    public function cameraVideos()
    {
        return $this->hasMany(CameraVideo::class);
    }
 

}
