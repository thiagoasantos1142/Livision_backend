<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Shows',
                'description' => 'Eventos musicais e apresentações ao vivo',
                'color' => '#FF5733'
            ],
            [
                'name' => 'Futebol', 
                'description' => 'Jogos e campeonatos de futebol',
                'color' => '#33FF57'
            ],
            [
                'name' => 'Filmes',
                'description' => 'Longas e curtas metragens',
                'color' => '#3357FF'
            ],
            [
                'name' => 'Séries',
                'description' => 'Conteúdo episódico',
                'color' => '#F033FF'
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'color' => $category['color'],
                'is_active' => true
            ]);
        }
    }
}