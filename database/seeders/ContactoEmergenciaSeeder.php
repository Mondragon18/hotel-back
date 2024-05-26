<?php

namespace Database\Seeders;

use App\Models\ContactoEmergencia;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactoEmergenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactoEmergencia::factory()->count(20)->create();
        
    }
}
