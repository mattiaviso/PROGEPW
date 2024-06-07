<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AddettiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "PROFILO";
    }
    public function indexVoli()
    {
        $dl = new DataLayer();
        $utenti = $dl->listaAddettiVoli();
        return view('addetti.indexAdVoli')->with('utenti', $utenti);
    }
    public function indexPrenotazioni()
    {
        $dl = new DataLayer();
        $utenti = $dl->listaAddettiPrenotazioni();
        return view('addetti.indexAdPrenotazioni')->with('utenti', $utenti);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dl = new DataLayer();
        $compagnie = $dl->listCompagnie();
        return view('addetti.create')->with('companies', $compagnie);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nome = $request->input('nome');
        $cognome = $request->input('cognome');
        $dataNascita = $request->input('data');
        $luogoNascita = $request->input('luogo');
        $email = $request->input('email');
        $password = $request->input('password');
        $compagnia_id = $request->input('compagnia');
        $ruolo = $request->input('ruolo');

        $dl = new DataLayer();
        $dl->addAddetti($nome, $cognome, $dataNascita, $luogoNascita, $email, $password, $compagnia_id, $ruolo);

        return Redirect::to(route('home'));



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
        $utente = $dl->findAddettoById($id);
        $compagnie = $dl->listCompagnie();
        return view('addetti.create')->with('addetti', $utente)->with('companies', $compagnie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nome = $request->input('nome');
        $cognome = $request->input('cognome');
        $dataNascita = $request->input('data');
        $luogoNascita = $request->input('luogo');
        $email = $request->input('email');
        $password = $request->input('password');
        $compagnia_id = $request->input('compagnia');
        $ruolo = $request->input('ruolo');

        $dl = new DataLayer();
        $dl->updateAddetti($id, $nome, $cognome, $dataNascita, $luogoNascita, $email, $password, $compagnia_id, $ruolo);

        return Redirect::to(route('home'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
