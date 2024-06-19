<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aerei;
use App\Models\Aereoporti;
use App\Models\Compagnie;
use App\Models\Voli;
use DateInterval;
use DateTime;


class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 20; $i++) {
            $veivolo = Aerei::inRandomOrder()->value('id');
            $comp = Compagnie::inRandomOrder()->value('id');

            $p = Aereoporti::inRandomOrder()->value('id');
            do {
                $a = Aereoporti::inRandomOrder()->value('id');
            } while ($a === $p);

            $lettera1 = chr(rand(65, 90));
            $lettera2 = chr(rand(65, 90));

            $now = new DateTime();
            $interval1 = new DateInterval('PT' . rand(0, 16) . 'H');
            $intervalDays = new DateInterval('P' . rand(0, 30) . 'D');
            $interval3 = new DateInterval('PT' . rand(0, 59) . 'M');
            $interval4 = new DateInterval('PT' . rand(0, 59) . 'M');
            $date1 = clone $now;
            $date1->add($interval1)->add($intervalDays)->add($interval3);
            $interval2 = new DateInterval('PT' . rand(0, 16) . 'H');
            $date2 = clone $date1;
            $date2->add($interval2)->add($interval4);

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
    }
}
