<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservas>
 */
class ReservasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'habitacion_id' => $this->faker->numberBetween(1, 5),
            'pasajero_id' => $this->faker->numberBetween(1, 5),
            'fecha_entrada' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'fecha_salida' => $this->faker->dateTimeBetween('+2 days', '+1 week'),
            'monto_total' => $this->faker->randomFloat(2, 50, 500),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']),
        ];
    }
}
