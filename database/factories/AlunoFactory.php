<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'matricula' => $this->faker->unique()->numerify(str_repeat('#', 14)),
            'data_nascimento' => $this->faker->dateTimeInInterval($date = '-15 years', $interval = '+5 days'),
            'sexo' => $this->faker->randomElement(['Masculino', 'Feminino', 'Outros']),
            'telefone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'responsavel' => $this->faker->randomElement([$this->faker->name(), '']),
            'telefone_responsavel' => $this->faker->randomElement([$this->faker->unique()->phoneNumber(), '']),
            'observacao' => $this->faker->text($maxNbChars = 30)
        ];
    }
}
