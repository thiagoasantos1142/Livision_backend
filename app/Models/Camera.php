<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;

     protected $fillable = [
        'event_id',
        'label',
        'angle',
        'is_live',
    ];

    protected $casts = [
        'is_live' => 'boolean',
    ];

     public function videos()
    {
        return $this->hasMany(CameraVideo::class);
    }
}
