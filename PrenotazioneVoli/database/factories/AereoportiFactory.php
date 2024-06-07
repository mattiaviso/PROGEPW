<?php

namespace Database\Factories;

use App\Models\Aereoporti;
use Illuminate\Database\Eloquent\Factories\Factory;


class AereoportiFactory extends Factory
{
    protected $model = Aereoporti::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->address,
            'codice_iata' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'lat' => $this->faker->latitude,
            'lon' => $this->faker->longitude
        ];
    }
}
