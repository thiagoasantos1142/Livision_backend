<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EventCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $categories = [
            // Esportes (event_type_id = 2)
            ['event_type_id' => 2, 'name' => 'Futebol', 'slug' => 'futebol'],
            ['event_type_id' => 2, 'name' => 'Fórmula 1', 'slug' => 'formula-1'],
            ['event_type_id' => 2, 'name' => 'Basquete', 'slug' => 'basquete'],
            ['event_type_id' => 2, 'name' => 'Vôlei', 'slug' => 'volei'],
            ['event_type_id' => 2, 'name' => 'Olimpíadas', 'slug' => 'olimpiadas'],
            ['event_type_id' => 2, 'name' => 'Skate', 'slug' => 'skate'],
            ['event_type_id' => 2, 'name' => 'eSports', 'slug' => 'esports'],

            // Show (event_type_id = 1)
            ['event_type_id' => 1, 'name' => 'Rock', 'slug' => 'rock'],
            ['event_type_id' => 1, 'name' => 'Pop', 'slug' => 'pop'],
            ['event_type_id' => 1, 'name' => 'Samba', 'slug' => 'samba'],
            ['event_type_id' => 1, 'name' => 'Sertanejo', 'slug' => 'sertanejo'],
            ['event_type_id' => 1, 'name' => 'Funk', 'slug' => 'funk'],
            ['event_type_id' => 1, 'name' => 'MPB', 'slug' => 'mpb'],
            ['event_type_id' => 1, 'name' => 'Eletrônica', 'slug' => 'eletronica'],

            // Teatro (event_type_id = 3)
            ['event_type_id' => 3, 'name' => 'Comédia', 'slug' => 'comedia'],
            ['event_type_id' => 3, 'name' => 'Drama', 'slug' => 'drama'],
            ['event_type_id' => 3, 'name' => 'Musical', 'slug' => 'musical'],
            ['event_type_id' => 3, 'name' => 'Infantil', 'slug' => 'infantil'],
        ];

        foreach ($categories as &$cat) {
            $cat['description'] = null;
            $cat['created_at'] = now();
            $cat['updated_at'] = now();
        }

        DB::table('event_categories')->insert($categories);
    }

}
