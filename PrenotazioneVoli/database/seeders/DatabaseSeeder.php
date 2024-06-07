<?php

namespace Database\Seeders;

use App\Models\Aerei;
use App\Models\Aereoporti;
use App\Models\Passeggeri;
use App\Models\User;
use App\Models\Compagnie;
use App\Models\Voli;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'nome' => 'Napoli Capodichino Airport',
            'codice_iata' => 'NAP',
            'city' => 'Napoli',
            'country' => 'Italia',
            'lat' => '40.8842',
            'lon' => '14.2908'
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
            'nome' => 'Beijing Capital International Airport',
            'codice_iata' => 'PEK',
            'city' => 'Beijing',
            'country' => 'China',
            'lat' => '40.0799',
            'lon' => '116.6031'
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
            'nome' => 'Air France',
            'anno_fondazione' => 1933,
            'sede' => 'Parigi',
            'country' => 'Francia',
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



        Passeggeri::factory(5)->create();



        $ae = Aereoporti::all()->count();


        for ($i = 0; $i < 20; $i++) {
            $veivolo = rand(1, 4);
            $comp = rand(1, 5);
            $p = rand(1, $ae);
            $a = rand(1, $ae);

            Voli::create([
                'numeroVolo' => 'IT' . $i,
                'orarioPartenza' => '2024-05-01 08:00:00',
                'orarioArrivo' => '2024-05-01 10:00:00',
                'aereoportoPartenza_id' => $p,
                'aereoportoArrivo_id' => $a,
                'aereo_id' => $veivolo,
                'compagnia_id' => $comp,
            ]);
        }









    }
}
