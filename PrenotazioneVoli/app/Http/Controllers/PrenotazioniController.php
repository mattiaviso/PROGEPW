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
        return view('errors.404')->with('message', 'Errore 404 - Pagina non trovata!');
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
        return view('errors.404')->with('message', 'Errore 404 - Pagina non trovata!');
    }

    public function eliminaPasseggeroConfirm($prenotazioneId, $passeggeroid)
    {
        $dl = new DataLayer();
        $passeggero = $dl->findPasseggeroByid($passeggeroid);
        $prenotazione = $dl->findPrenotazioneById($prenotazioneId);
        $countPasseggeri = $prenotazione->passeggeri->count();


        if (!$passeggero || !$prenotazione) {
            return response()->view('errors.404', ['message' => 'Passeggero per questa prenotazione non trovato']);
        } elseif ($prenotazione->cliente_id != $_SESSION['loggedID']) {
            return response()->view('errors.404', ['message' => 'NON HAI ACCESSO A QUESTA PAGINA']);
        } elseif ($countPasseggeri == 1) {
            return response()->view('errors.404', ['message' => 'NON PUOI ELIMINARE l UNICO PASSEGGERO DI QUESTA PRENOTAZIONE']);
        } else {
            return view('prenotazioni.deleteConfirm')->with('prenotazione', $prenotazione)->with('passeggero', $passeggero);
        }

    }

    public function eliminaPasseggero($prenotazioneId, $passeggero)
    {
        $dl = new DataLayer();
        $dl->deletePasseggeroFromPrenotazione($prenotazioneId, $passeggero);

        return Redirect::to(route('prenotazioni.index'));
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
        } else {
            return view('prenotazioni.edit')->with('volo', $volo);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('errors.404')->with('message', 'Errore 404 - Pagina non trovata!');
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
