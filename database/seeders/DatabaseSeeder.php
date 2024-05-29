<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Deshabilitar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpiar las tablas
        DB::table('servicios')->truncate();
        DB::table('hoteles')->truncate();
        DB::table('habitacion')->truncate();
        DB::table('users')->truncate();
        // DB::table('pasajeros')->truncate();
        // DB::table('reservas')->truncate();
        // DB::table('contacto_emergencia')->truncate();

        // Habilitar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ejecutar los seeders
        $this->call(ServiciosSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(HabitacionSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(PasajerosSeeder::class);
        // $this->call(ReservasSeeder::class);
        // $this->call(ContactoEmergenciaSeeder::class);
    }
}
