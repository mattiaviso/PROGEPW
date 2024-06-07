<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Passeggeri;


class PasseggeriFactory extends Factory
{
    protected $model = Passeggeri::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cognome' => $this->faker->lastName
        ];
    }
}
