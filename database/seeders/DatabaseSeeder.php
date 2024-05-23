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
        $this->call(ServiciosSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(HabitacionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PasajerosSeeder::class);
        $this->call(ReservasSeeder::class);
        $this->call(ContactoEmergenciaSeeder::class);
    }
}
