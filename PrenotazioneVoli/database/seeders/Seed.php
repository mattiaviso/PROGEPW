<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Clienti;
use App\Models\Passeggeri;
use App\Models\Prenotazioni;
use App\Models\Voli;


class Seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clienti::create([
            'nome' => 'Mattia',
            'cognome' => 'Visini',
            'dataNascita' => '1999-06-01',
            'luogoNascita' => 'Brescia',
            'email' => 'mattia@unibs.it',
            'password' => Hash::make('password'),
            'ruolo' => 'cliente',
        ]);

        Clienti::create([
            'nome' => 'Luca',
            'cognome' => 'Visini',
            'dataNascita' => '2001-06-01',
            'luogoNascita' => 'Brescia',
            'email' => 'admin@unibs.it',
            'password' => Hash::make('password'),
            'ruolo' => 'admin',
        ]);


        Clienti::factory(5)->create();


        Passeggeri::factory(100)->create();

        $volitot = Voli::all();
        foreach ($volitot as $volo) {
            //per ogni volo fai un numero casuale di prenotazioni
            $n = rand(1, 3);
            for ($i = 0; $i < $n; $i++) {
                Prenotazioni::factory()->create([
                    'volo_id' => $volo->id,
                    'cliente_id' => Clienti::where('ruolo', 'cliente')->inRandomOrder()->first()->id,
                ]);
            }
        }

        Prenotazioni::factory(5)->create();


        $prenotaazioni = Prenotazioni::all();

        foreach ($prenotaazioni as $prenotazione) {
            $passeggeri = Passeggeri::inRandomOrder()->limit(rand(1, 3))->get();
            $prenotazione->passeggeri()->attach($passeggeri);
        }
    }
}
