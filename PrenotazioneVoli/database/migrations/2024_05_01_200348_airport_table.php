<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aereoporti', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('codice_iata');
            $table->string('city');
            $table->string('country');
            $table->float('lat', 10, 7);
            $table->float('lon', 10, 7);
            $table->timestamps();
        });

        Schema::create('compagnie', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedSmallInteger('anno_fondazione');
            $table->string('sede');
            $table->string('country');
            $table->timestamps();
        });

        Schema::create('aerei', function (Blueprint $table) {
            $table->id();
            $table->string('nomeModello');
            $table->unsignedSmallInteger('capacita');
            $table->timestamps();
        });

        Schema::create('passeggeri', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->timestamps();
        });

        Schema::create('voli', function (Blueprint $table) {
            $table->id();
            $table->string('numeroVolo');
            $table->unsignedBigInteger('aereo_id');
            $table->unsignedBigInteger('aereoportoPartenza_id');
            $table->unsignedBigInteger('aereoportoArrivo_id');
            $table->unsignedBigInteger('compagnia_id');
            $table->dateTime('orarioPartenza');
            $table->dateTime('orarioArrivo');
            $table->timestamps();
        });

        Schema::table('voli', function (Blueprint $table) {
            $table->foreign('aereo_id')->references('id')->on('aerei');
            $table->foreign('aereoportoPartenza_id')->references('id')->on('aereoporti');
            $table->foreign('aereoportoArrivo_id')->references('id')->on('aereoporti');
            $table->foreign('compagnia_id')->references('id')->on('compagnie');
        });



        Schema::create('clienti', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->date('dataNascita');
            $table->string('luogoNascita');
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('compagnia_id')->nullable();

            // Campo 'ruolo' con vincolo di restrizione sui valori accettabili
            $table->enum('ruolo', ['inserimento', 'prenotazioni', 'admin', 'cliente']);

            $table->timestamps();
        });

        Schema::table('clienti', function (Blueprint $table) {
            $table->foreign('compagnia_id')->references('id')->on('compagnie');
        });

        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dataPrenotazione');
            $table->unsignedBigInteger('volo_id');
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();
        });

        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->foreign('volo_id')->references('id')->on('voli');
            $table->foreign('cliente_id')->references('id')->on('clienti');
        });

        Schema::create('prenotazioni_passeggeri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prenotazione_id');
            $table->unsignedBigInteger('passeggero_id');
            $table->timestamps();
        });

        Schema::table('prenotazioni_passeggeri', function (Blueprint $table) {
            $table->foreign('prenotazione_id')->references('id')->on('prenotazioni');
            $table->foreign('passeggero_id')->references('id')->on('passeggeri');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
