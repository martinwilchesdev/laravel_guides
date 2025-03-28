<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(), // genera un nombre aleatorio
            'precio' => $this->faker->randomFloat(2, 100, 2000), // precio entre 100 y 2000 con una precision de 2 decimales
            'descripcion' => $this->faker->sentence() // genera una descripcion corta
        ];
    }
}
