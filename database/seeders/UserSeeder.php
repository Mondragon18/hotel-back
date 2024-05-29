<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $now = Carbon::now();

    DB::table('users')->insert([
      [
        'usuario' => 'admin',
        'nombres' => 'Admin',
        'apellidos' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('adminadmin'),
        'persona' => 'agente', // Otra opción es usar un rol específico como 'admin'
        'created_at' => $now,
        'updated_at' => $now
      ]
    ]);

    // User::factory()->count(20)->create();
  }
}
