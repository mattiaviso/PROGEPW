<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Clienti;
use App\Models\Passeggeri;
use App\Models\Prenotazioni;
use App\Models\Voli;


class userSeeder extends Seeder
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
            'email' => 'user',
            'password' => Hash::make('user'),
            'ruolo' => 'cliente',
        ]);

        Clienti::create([
            'nome' => 'Luca',
            'cognome' => 'Visini',
            'dataNascita' => '2001-06-01',
            'luogoNascita' => 'Brescia',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'ruolo' => 'admin',
        ]);


    }
}