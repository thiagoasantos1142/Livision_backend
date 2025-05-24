<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'rating',
        'year_launched',
        'duration',
        'is_open',
        'published',
        'category_id',
        'season_id',
        'episode_number'
    ];
    use HasFactory;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
