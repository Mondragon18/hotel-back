<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // Define los datos de agente
    $agentData = [
      'usuario' => $this->faker->userName,
      'nombres' => $this->faker->firstName,
      'apellidos' => $this->faker->lastName,
      'email' => $this->faker->unique()->safeEmail,
      'password' => static::$password ??= Hash::make('admin'), // Otra contraseña si es necesario
      'persona' => 'pasajero',
    ];

    // Selecciona aleatoriamente entre los datos de administrador y agente
    $userData = $this->faker->randomElement([$agentData]);

    return $userData;
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  // public function unverified(): static
  // {
  //     return $this->state(fn (array $attributes) => [
  //         'email_verified_at' => null,
  //     ]);
  // }
}
