<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenresSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => 'Rock'],
            ['name' => 'Pop'],
            ['name' => 'Ação'],
            ['name' => 'Drama'],
            ['name' => 'Comédia'],
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
                'slug' => Str::slug($genre['name']),
                'is_active' => true
            ]);
        }
    }
}