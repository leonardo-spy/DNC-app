<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Funcionarios;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checkin>
 */
class CheckinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'func_cpf' => Funcionarios::all()->random()->cpf,
            'created_at' => \Carbon\Carbon::yesterday(),
            'updated_at' => \Carbon\Carbon::now(),
        ];
    }
}
