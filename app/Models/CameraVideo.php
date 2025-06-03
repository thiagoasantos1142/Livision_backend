<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CameraVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_id',
        'filename',
        'path',
        'duration',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }
}

