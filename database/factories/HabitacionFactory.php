<?php

namespace Database\Factories;

use App\Models\Habitacion;
use App\Models\Hotel;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habitacion>
 */
class HabitacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => $this->faker->numberBetween(1, 5),
            'tipo' => $this->faker->word,
            'numero_persona' => $this->faker->numberBetween(1, 6),
            'descripcion' => $this->faker->sentence,
            'costo_base' => $this->faker->randomFloat(2, 10, 1000),
            'impuestos' => $this->faker->randomFloat(2, 1, 200),
            'activo' => $this->faker->boolean,
        ];
    }
}
