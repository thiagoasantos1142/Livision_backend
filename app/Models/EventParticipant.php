<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

     protected $fillable = [
        'event_id',
        'participant_id',
        'role',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
