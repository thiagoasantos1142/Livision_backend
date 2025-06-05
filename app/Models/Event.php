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
 


 

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }


    public function cameraAudios()
    {
        return $this->hasMany(CameraAudio::class);
    }

    public function cameraImages()
    {
        return $this->hasMany(CameraImage::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }
    public function getStartTimeFormattedAttribute()
    {
        return $this->start_time ? $this->start_time->format('Y-m-d H:i:s') : null;
    }
    public function getEndTimeFormattedAttribute()
    {
        return $this->end_time ? $this->end_time->format('Y-m-d H:i:s') : null;
    }
    public function getIsOpenAttribute($value)
    {
        return (bool) $value;
    }
    public function getPublishedAttribute($value)
    {
        return (bool) $value;
    }
    public function getGeneralInfoAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setGeneralInfoAttribute($value)
    {
        $this->attributes['general_info'] = json_encode($value);
    }
}
