<?php

namespace Database\Factories;

use App\Models\Prenotazioni;
use App\Models\Voli;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clienti;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prenotazioni>
 */
class PrenotazioniFactory extends Factory
{
    protected $model = Prenotazioni::class;
    public function definition(): array
    {
        return [
            'dataPrenotazione' => $this->faker->dateTimeThisYear(),
            'volo_id' => Voli::inRandomOrder()->first()->id,
            'cliente_id' => function () {
                return Clienti::where('ruolo', 'cliente')->inRandomOrder()->first()->id;
            },

        ];
    }
}
