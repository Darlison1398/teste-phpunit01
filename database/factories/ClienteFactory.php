<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClienteFactory extends Factory
{
    // O modelo associado a esta fábrica
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'UUID' => (string) Str::uuid(),
            'nome' => $this->faker->firstName,
            'sobrenome' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => $this->faker->phoneNumber,
        ];
    }
}
