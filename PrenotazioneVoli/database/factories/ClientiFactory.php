<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clienti>
 */
class ClientiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $ruolo = $this->faker->randomElement(['cliente', 'inserimento', 'prenotazioni']);

        // Assegna compagnia_id solo se il ruolo non è cliente
        $compagniaId = null;
        if ($ruolo !== 'cliente') {
            $compagniaId = \App\Models\Compagnie::inRandomOrder()->first()->id;
        }

        return [
            'nome' => $this->faker->firstName,
            'cognome' => $this->faker->lastName,
            'dataNascita' => $this->faker->date,
            'luogoNascita' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Hashed password
            'compagnia_id' => $compagniaId,
            'ruolo' => $ruolo,
        ];
    }
}
