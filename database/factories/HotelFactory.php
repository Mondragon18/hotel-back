<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    protected $model = Hotel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
          'nombre' => $this->faker->company,
          'direccion' => $this->faker->address,
          'ciudad' => $this->faker->city,
          'pais' => $this->faker->country,
          'telefono' => $this->faker->phoneNumber,
          'email' => $this->faker->unique()->safeEmail,
          'clasificacion' => $this->faker->numberBetween(1, 5),
          // 'servicios' => $this->faker->words(3, true),
          'descripcion' => $this->faker->paragraph,
          'fecha_apertura' => $this->faker->date,
          // 'imagenes' => $this->faker->imageUrl,
          'pagina_web' => $this->faker->url,
          'activo' => $this->faker->boolean,
      ];
    }
}
