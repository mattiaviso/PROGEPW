<?php

namespace Database\Factories;

use App\Models\Compagnie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compagnie>
 */
class CompagnieFactory extends Factory
{
    protected $model = Compagnie::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'anno_fondazione' => $this->faker->year,
            'sede' => $this->faker->city,
            'country' => $this->faker->country
        ];
    }
}

