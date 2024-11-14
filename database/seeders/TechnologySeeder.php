<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technology::create(['name' => 'HTML']);
        Technology::create(['name' => 'CSS']);
        Technology::create(['name' => 'JavaScript']);
        Technology::create(['name' => 'Vue']);
        Technology::create(['name' => 'PHP']);
        Technology::create(['name' => 'Laravel']);
    }
}