<?php

namespace Database\Seeders;

use App\Models\Pasajero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasajerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pasajero::factory()->count(5)->create();
    }

    
}
