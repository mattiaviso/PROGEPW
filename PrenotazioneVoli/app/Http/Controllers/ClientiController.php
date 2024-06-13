<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;



class ClientiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function profilo()
    {
        $dl = new DataLayer();
        $cliente = $dl->getClienteById($_SESSION['loggedID']);
        return view('accesso.account')->with('cliente', $cliente);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accesso.registrazione');
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

        $dl = new DataLayer();
        $dl->addCliente($nome, $cognome, $dataNascita, $luogoNascita, $email, $password);

        return Redirect::to(route('home'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function aggiorna(Request $request)
    {
        $id = $_SESSION['loggedID'];
        $nome = $request->input('nome');
        $cognome = $request->input('cognome');
        $dataNascita = $request->input('dataNascita');
        $luogoNascita = $request->input('luogoNascita');
        $email = $request->input('email');

        $_SESSION['loggedName'] = $nome;

        $dl = new DataLayer();
        $dl->updateAddettiNoPassword($id, $nome, $cognome, $dataNascita, $luogoNascita, $email);

        return Redirect::to(route('profilo'));
    }

    public function aggiornaPass(Request $request)
    {

        $id = $_SESSION['loggedID'];
        $password = $request->input('passwordnew1');

        $dl = new DataLayer();
        $dl->updatePassword($id, $password);

        return Redirect::to(route('profilo'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
