<?php

namespace Database\Factories;

use App\Models\Pasajero;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasajeros>
 */
class PasajeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '-18 years'), // Genera una fecha de nacimiento para alguien mayor de 18 años
            'genero' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'tipo_documento' => $this->faker->randomElement(['DNI', 'Pasaporte', 'Carnet de identidad']),
            'numero_documento' => $this->faker->unique()->numberBetween(10000000, 99999999), // Número de documento único
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
