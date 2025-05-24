<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Series;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    public function run()
    {
       Series::create([
            'title' => 'Breaking Bad',
            'slug' => Str::slug('Breaking Bad'),
            'description' => 'Um professor de química se transforma em um criminoso',
            'year_launched' => 2008,
            'is_active' => true
        ]);
    }
}