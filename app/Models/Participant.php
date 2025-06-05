<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

       protected $fillable = [
        'name'  ,
        'type'  // Tipo do participante, por exemplo: 'speaker', 'moderator', etc.
    ];
}
