<?php

namespace Database\Seeders;

use App\Models\Aerei;
use App\Models\Aereoporti;
use App\Models\Passeggeri;
use App\Models\Prenotazioni;
use App\Models\User;
use App\Models\Compagnie;
use App\Models\Voli;
use App\Models\Clienti;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateInterval;
use DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Aereoporti::create([
            'nome' => 'Milano Malpensa Airport',
            'codice_iata' => 'MXP',
            'city' => 'Milano',
            'country' => 'Italia',
            'lat' => '45.6306',
            'lon' => '8.7281'
        ]);

        Aereoporti::create([
            'nome' => 'Roma Fiumicino Airport',
            'codice_iata' => 'FCO',
            'city' => 'Roma',
            'country' => 'Italia',
            'lat' => '41.8003',
            'lon' => '12.2389'
        ]);

        Aereoporti::create([
            'nome' => 'Orio al Serio International Airport',
            'codice_iata' => 'BGY',
            'city' => 'Bergamo',
            'country' => 'Italia',
            'lat' => '45.6689',
            'lon' => '9.7042'
        ]);

        Aereoporti::create([
            'nome' => 'Bologna Guglielmo Marconi Airport',
            'codice_iata' => 'BLQ',
            'city' => 'Bologna',
            'country' => 'Italia',
            'lat' => '44.5354',
            'lon' => '11.2887'
        ]);


        Aereoporti::create([
            'nome' => 'San Francisco International Airport',
            'codice_iata' => 'SFO',
            'city' => 'San Francisco',
            'country' => 'USA',
            'lat' => '37.6188',
            'lon' => '-122.3758'
        ]);

        Aereoporti::create([
            'nome' => 'Los Angeles International Airport',
            'codice_iata' => 'LAX',
            'city' => 'Los Angeles',
            'country' => 'USA',
            'lat' => '33.9416',
            'lon' => '-118.4085'
        ]);

        Aereoporti::create([
            'nome' => 'London Heathrow Airport',
            'codice_iata' => 'LHR',
            'city' => 'London',
            'country' => 'UK',
            'lat' => '51.4700',
            'lon' => '-0.4543'
        ]);

        Aereoporti::create([
            'nome' => 'Paris Charles de Gaulle Airport',
            'codice_iata' => 'CDG',
            'city' => 'Paris',
            'country' => 'France',
            'lat' => '49.0097',
            'lon' => '2.5479'
        ]);

        Aereoporti::create([
            'nome' => 'Dubai International Airport',
            'codice_iata' => 'DXB',
            'city' => 'Dubai',
            'country' => 'UAE',
            'lat' => '25.2532',
            'lon' => '55.3657'
        ]);

        Aereoporti::create([
            'nome' => 'Sydney Kingsford Smith Airport',
            'codice_iata' => 'SYD',
            'city' => 'Sydney',
            'country' => 'Australia',
            'lat' => '-33.9461',
            'lon' => '151.1772'
        ]);

        Aereoporti::create([
            'nome' => 'Tokyo Haneda Airport',
            'codice_iata' => 'HND',
            'city' => 'Tokyo',
            'country' => 'Japan',
            'lat' => '35.5494',
            'lon' => '139.7798'
        ]);

        Aereoporti::create([
            'nome' => 'Moscow Sheremetyevo International Airport',
            'codice_iata' => 'SVO',
            'city' => 'Moscow',
            'country' => 'Russia',
            'lat' => '55.9726',
            'lon' => '37.4146'
        ]);

        Aereoporti::create([
            'nome' => 'Rio de Janeiro Galeão International Airport',
            'codice_iata' => 'GIG',
            'city' => 'Rio de Janeiro',
            'country' => 'Brazil',
            'lat' => '-22.8124',
            'lon' => '-43.2505'
        ]);

        Aereoporti::create([
            'nome' => 'Cape Town International Airport',
            'codice_iata' => 'CPT',
            'city' => 'Cape Town',
            'country' => 'South Africa',
            'lat' => '-33.9681',
            'lon' => '18.6022'
        ]);



        Compagnie::create([
            'nome' => 'Ita Airways',
            'anno_fondazione' => 2021,
            'sede' => 'Fiumicino',
            'country' => 'Italia',
        ]);

        Compagnie::create([
            'nome' => 'Ryanair',
            'anno_fondazione' => 1984,
            'sede' => 'Dublino',
            'country' => 'Irlanda',
        ]);

        Compagnie::create([
            'nome' => 'Emirates',
            'anno_fondazione' => 1985,
            'sede' => 'Dubai',
            'country' => 'Emirati Arabi Uniti',
        ]);

        Compagnie::create([
            'nome' => 'Lufthansa',
            'anno_fondazione' => 1953,
            'sede' => 'Colonia',
            'country' => 'Germania',
        ]);

        Compagnie::create([
            'nome' => 'Qatar Airways',
            'anno_fondazione' => 1993,
            'sede' => 'Doha',
            'country' => 'Qatar',
        ]);

        Compagnie::create([
            'nome' => 'Etihad Airways',
            'anno_fondazione' => 2003,
            'sede' => 'Abu Dhabi',
            'country' => 'Emirati Arabi Uniti',
        ]);

        Aerei::create([
            'nomeModello' => 'Boeing 747',
            'capacita' => 524,
        ]);

        Aerei::create([
            'nomeModello' => 'Airbus A380',
            'capacita' => 853,
        ]);

        Aerei::create([
            'nomeModello' => 'Boeing 777',
            'capacita' => 396,
        ]);

        Aerei::create([
            'nomeModello' => 'Airbus A350',
            'capacita' => 440,
        ]);



        for ($i = 0; $i < 10; $i++) {
            $veivolo = Aerei::inRandomOrder()->value('id');
            $comp = Compagnie::inRandomOrder()->value('id');

            $p = Aereoporti::inRandomOrder()->value('id');
            do {
                $a = Aereoporti::inRandomOrder()->value('id');
            } while ($a === $p);

            $lettera1 = chr(rand(65, 90)); // Genera una lettera maiuscola ASCII
            $lettera2 = chr(rand(65, 90)); // Genera una lettera maiuscola ASCII

            $now = new DateTime();
            $interval1 = new DateInterval('PT' . rand(0, 16) . 'H');
            $intervalDays = new DateInterval('P' . rand(0, 30) . 'D');
            $date1 = clone $now;
            $date1->add($interval1)->add($intervalDays);
            $interval2 = new DateInterval('PT' . rand(0, 16) . 'H');
            $date2 = clone $date1;
            $date2->add($interval2);


            $numero = rand(1000, 9999);

            Voli::create([
                'numeroVolo' => $lettera1 . $lettera2 . $numero,
                'orarioPartenza' => $date1->format('Y-m-d H:i:s'),
                'orarioArrivo' => $date2->format('Y-m-d H:i:s'),
                'aereoportoPartenza_id' => $p,
                'aereoportoArrivo_id' => $a,
                'aereo_id' => $veivolo,
                'compagnia_id' => $comp,
            ]);
        }

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

        Passeggeri::factory(10)->create();

        Prenotazioni::factory(50)->create();


        $prenotaazioni = Prenotazioni::all();

        foreach ($prenotaazioni as $prenotazione) {
            $passeggeri = Passeggeri::inRandomOrder()->limit(rand(1, 5))->get();
            $prenotazione->passeggeri()->attach($passeggeri);
        }





    }
}
