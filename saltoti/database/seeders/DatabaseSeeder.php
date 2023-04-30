<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*\App\Models\Uzem::factory(10)->create();
        \App\Models\Sensor::factory(100)->create();
        \App\Models\Vizfogyasztas::factory(4)->create();
        \App\Models\Elszivo::factory(20)->create();
        \App\Models\Termelogep::factory(20)->create();
        \App\Models\Kompresszor::factory(15)->create();*/
        \App\Models\SensorData::factory(499)->create();
    }
}
