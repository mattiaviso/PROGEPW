<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class VoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dl = new DataLayer();
        $voli = $dl->listVoli();
        $aeroportiPartenza = $dl->listAirportPartenza();
        $aeroportiArrivo = $dl->listAirportArrivo();
        return view('voli.index')->with('voli', $voli)->with('aeroportiPartenza', $aeroportiPartenza)->with('aeroportiArrivo', $aeroportiArrivo);
    }

    public function search(string $city)
    {

        $dl = new DataLayer();
        $voli = $dl->listVoli();
        $aeroportiPartenza = $dl->listAirportPartenza();
        $aeroportiArrivo = $dl->listAirportArrivo();
        return view('voli.index')->with('voli', $voli)->with('aeroportiPartenza', $aeroportiPartenza)->with('aeroportiArrivo', $aeroportiArrivo)->with('city', $city);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dl = new DataLayer();
        $airports = $dl->listAirport();
        $velivoli = $dl->listAerei();
        return view('voli.editVolo')->with('aeroporti', $airports)->with('velivoli', $velivoli);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $numeroVolo = $request->input('numero');
        $aereo_id = $request->input('velivolo');
        $compagnia_id = 1;
        $aereoporto_partenza_id = $request->input('partenza');
        $aereoporto_arrivo_id = $request->input('arrivo');
        $orario_partenza = $request->input('oraP');
        $orario_arrivo = $request->input('oraA');


        $dl = new DataLayer();
        $dl->addVolo($numeroVolo, $aereo_id, $compagnia_id, $aereoporto_partenza_id, $aereoporto_arrivo_id, $orario_partenza, $orario_arrivo);

        return Redirect::to(route('addettoVoli'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $volo = $dl->findFlightByID($id);

        if (isset($_SESSION) && $_SESSION['ruolo'] == "inserimento") {

            $compagniaId_Logged_User = $dl->findCompagniaByUserID($_SESSION['loggedID']);
        } else {
            $compagniaId_Logged_User = null;
        }

        if (!$volo) {
            return response()->view('errors.404', ['message' => 'Volo non trovato']);
        }

        return view('voli.show')->with('volo', $volo)->with('compagniaUser', $compagniaId_Logged_User);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $volo = $dl->findFlightByID($id);
        $airports = $dl->listAirport();
        $velivoli = $dl->listAerei();
        return view('voli.editVolo')->with('volo', $volo)->with('aeroporti', $airports)->with('velivoli', $velivoli);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $numeroVolo = $request->input('numero');
        $aereo_id = $request->input('velivolo');
        $compagnia_id = 1;
        $aereoporto_partenza_id = $request->input('partenza');
        $aereoporto_arrivo_id = $request->input('arrivo');
        $orario_partenza = $request->input('oraP');
        $orario_arrivo = $request->input('oraA');


        $dl = new DataLayer();
        $dl->editVolo($id, $numeroVolo, $aereo_id, $compagnia_id, $aereoporto_partenza_id, $aereoporto_arrivo_id, $orario_partenza, $orario_arrivo);

        return Redirect::to(route('addettoVoli'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deleteVolo($id);
        return Redirect::to(route('addettoVoli'));
    }

    public function confirmDestroy(string $id)
    {
        $dl = new DataLayer();
        $volo = $dl->findFlightByID($id);
        return view('voli.deleteVolo')->with('volo', $volo);
    }
}
