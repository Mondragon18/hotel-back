<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactoEmergencia>
 */
class ContactoEmergenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reserva_id' => $this->faker->numberBetween(1, 3),
            'nombres' => $this->faker->firstName,
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
