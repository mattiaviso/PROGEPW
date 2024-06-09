<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use App\Models\Passeggeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PrenotazioniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        //$prenotazioni = $dl->listPrenotazioni();
        $prenotazioni = $dl->listPrenotazioniById($_SESSION['loggedID']);
        return view('prenotazioni.index')->with('prenotazioni', $prenotazioni);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //SALVA SU DB LA NUOVA PRENOTAZIONE E POI INSERISCI PASSEGGERI IN DB E POI FAI ATTACH
        $dl = new DataLayer();
        $data = date('Y-m-d H:i:s');

        $id_prenotazione = $dl->addPrenotazione($request->input('volo_id'), $request->input('utente_id'), $data);
        //return Redirect::to(route('voli.index'));

        $pass = $request->input('passengers');


        foreach ($pass as $p) {
            //se passeggero è gia presente nel db non lo inserisco, e mi faccio restituire l'id altrimento lo inserisco
            if ($dl->findPasseggero($p['first_name'], $p['last_name']) == null) {
                $id_Pass = $dl->addPasseggero($p['first_name'], $p['last_name']);
            } else {
                $id_Pass = $dl->findPasseggero($p['first_name'], $p['last_name']);
            }

            $dl->addPrenotationPasseggero($id_prenotazione, $id_Pass);
        }

        return Redirect::to(route('voli.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $volo = $dl->findFlightByID($id);
        if (!$volo) {
            return response()->view('errors.404', ['message' => 'Questo volo non esiste']);
        }

        return view('prenotazioni.edit')->with('volo', $volo);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deletePrenotazione($id);

        return Redirect::to(route('prenotazioni.index'));
    }

    public function aggiorna(Request $request)
    {
        $dl = new DataLayer();

        $id_prenotazione = $request->input('idPre');
        $pas = $request->input('nome');
        $pasC = $request->input('cognome');

        $dl->detachAllPassangerInPrenotazione($id_prenotazione);


        for ($i = 0; $i < count($pas); $i++) {

            if ($dl->findPasseggero($pas[$i], $pasC[$i]) == null) {
                $id_Pass = $dl->addPasseggero($pas[$i], $pasC[$i]);
            } else {
                $id_Pass = $dl->findPasseggero($pas[$i], $pasC[$i]);
            }

            $dl->addPrenotationPasseggero($id_prenotazione, $id_Pass);

        }


        return Redirect::to(route('prenotazioni.index'));
    }
}
