<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VideosSeeder extends Seeder
{
    public function run()
    {
        $videos = [
            [
                'title' => 'Show do Metallica - Ao Vivo',
                'description' => 'Show completo em São Paulo',
                'type' => 'live_event',
                'rating' => '16',
                'year_launched' => 2023,
                'is_open' => false,
                'published' => true
            ],
            [
                'title' => 'Final da Champions League',
                'description' => 'Jogo final da temporada 2023',
                'type' => 'recorded_event',
                'rating' => 'L',
                'year_launched' => 2023,
                'is_open' => true,
                'published' => true
            ]
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}