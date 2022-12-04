<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServidorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'tipo' => $this->faker->randomElement(['Professor', 'Tec. Admin. Educacional']),
        ];
    }
}
