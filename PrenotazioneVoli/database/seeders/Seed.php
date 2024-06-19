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

        Clienti::factory(10)->create();
        Passeggeri::factory(10)->create();

        $volitot = Voli::all();
        foreach ($volitot as $volo) {
            
            
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
