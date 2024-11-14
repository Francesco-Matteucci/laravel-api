<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fullStackType = Type::where('name', 'full-stack')->first();
        $frontEndType = Type::where('name', 'front-end')->first();
        $backEndType = Type::where('name', 'back-end')->first();
        $databaseType = Type::where('name', 'database')->first();

        Project::create([
            'title' => 'Boolflix',
            'description' => "Un'applicazione web simile a Netflix sviluppata con Vue.js e Vite.",
            'url' => 'https://github.com/Francesco-Matteucci/vite-boolflix',
            'type_id' => $frontEndType->id,
        ]);

        Project::create([
            'title' => 'Boolzapp',
            'description' => "Boolzapp è una semplice applicazione di messaggistica che replica le funzionalità base di WhatsApp.",
            'url' => 'https://github.com/Francesco-Matteucci/vue-boolzapp',
            'type_id' => $frontEndType->id,
        ]);

        Project::create([
            'title' => 'Yu-Gi-Oh Card Viewer',
            'description' => "Un'applicazione Vue 3 che permette di visualizzare un elenco di carte Yu-Gi-Oh",
            'url' => 'https://github.com/Francesco-Matteucci/vite-yu-gi-oh',
            'type_id' => $frontEndType->id,
        ]);

        Project::create([
            'title' => 'laravel-auth',
            'description' => "Una Dashboard per un portfolio di vari progetti di web-developer.",
            'url' => 'https://github.com/Francesco-Matteucci/laravel-auth',
            'type_id' => $fullStackType->id,
        ]);

        Project::create([
            'title' => 'db-university',
            'description' => "Questo progetto è un esercizio SQL volto a praticare l'uso di operazioni avanzate come JOIN, GROUP BY e funzioni di aggregazione",
            'url' => 'https://github.com/Francesco-Matteucci/db-university',
            'type_id' => $databaseType->id,
        ]);

        Project::create([
            'title' => 'php-oop-2',
            'description' => "Un progetto di e-commerce per la vendita di prodotti per animali domestici.",
            'url' => 'https://github.com/Francesco-Matteucci/php-oop-2',
            'type_id' => $backEndType->id,
        ]);
    }
}