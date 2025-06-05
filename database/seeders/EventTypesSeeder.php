<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Show',
                'slug' => 'show',
                'description' => 'Apresentações musicais, festivais',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Esportes',
                'slug' => 'esportes',
                'description' => 'Eventos e campeonatos esportivos',
                 'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Teatro',
                'slug' => 'teatro',
                'description' => 'Peças e espetáculos teatrais',
                 'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Conferência',
                'slug' => 'conferencia',
                'description' => 'Eventos corporativos, palestras',
                 'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Religioso',
                'slug' => 'religioso',
                'description' => 'Missas, cultos e celebrações religiosas',
                'is_active' => true,

                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cultural',
                'slug' => 'cultural',
                'description' => 'Eventos folclóricos e culturais',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tecnologia',
                'slug' => 'tecnologia',
                'description' => 'Lançamentos, hackathons e feiras tech',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Educacional',
                'slug' => 'educacional',
                'description' => 'Aulas, seminários e eventos educacionais',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'slug' => 'outros',
                'description' => 'Outros tipos de eventos',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('event_types')->insert($types);
    }

}
