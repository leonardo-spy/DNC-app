<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionarios>
 */
class FuncionariosFactory extends Factory
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
            'cpf' => $this->faker->unique()->numberBetween($min = 11111111111, $max = 99999999999),
            'created_at' => \Carbon\Carbon::yesterday(),
            'updated_at' => \Carbon\Carbon::now(),
        ];
    }
}
