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
        // Genera una fecha de entrada aleatoria dentro de los últimos 3 meses
        $fechaEntrada = $this->faker->dateTimeBetween('-3 months', 'now');

        // Genera una fecha de salida aleatoria que sea al menos 2 días después de la fecha de entrada y no más de 1 semana después
        $fechaSalida = $this->faker->dateTimeBetween($fechaEntrada->format('Y-m-d').' +2 days', $fechaEntrada->format('Y-m-d').' +1 week');

        return [
            'habitacion_id' => $this->faker->numberBetween(1, 5),
            'pasajero_id' => $this->faker->numberBetween(1, 5),
            'fecha_entrada' => $fechaEntrada,
            'fecha_salida' => $fechaSalida,
            'monto_total' => $this->faker->randomFloat(2, 50, 500),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']),
        ];
    }
}
