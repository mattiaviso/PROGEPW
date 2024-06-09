<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;


class AuthController extends Controller
{
    public function authentication()
    {
        return view('accesso.login');
    }

    public function registrazione()
    {
        return view('accesso.registrazione');
    }


    public function ajaxPrenotazioneGiaPresente(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->checkPrenotazione($request->input('idVolo'), $request->input('idCliente'))) {
            $response = array('found' => true); //gia presente
        } else {
            $response = array('found' => false);    //non presente
        }
        return response()->json($response);
    }

    public function login(Request $request)
    {
        session_start();

        $dl = new DataLayer();
        if ($dl->validUser($request->input('email'), $request->input('password'))) {
            $_SESSION['logged'] = true;
            $_SESSION['loggedID'] = $dl->getUserID($request->input('email'));
            $_SESSION['loggedName'] = $dl->getUserName($request->input('email'));
            $_SESSION['ruolo'] = $dl->getUserRole($request->input('email'));

            return Redirect::to(route('home'));

        } else {
            return Redirect::to(route('user.login'))->with('error', 'Credenziali non valide');
        }
    }
    public function logout()
    {
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }

    public function registration(Request $request)
    {
        $dl = new DataLayer();

        if ($request->input('ruolo') == 'cliente') {
            $dl->addCliente($request->input('nome'), $request->input('cognome'), $request->input('data'), $request->input('luogo'), $request->input('email'), $request->input('password'));
        } else {
            $dl->addAddetti($request->input('nome'), $request->input('cognome'), $request->input('data'), $request->input('luogo'), $request->input('email'), $request->input('password'), $request->input('compagnia'), $request->input('ruolo'));
        }

        return Redirect::to(route('user.login'));
    }


    public function ajaxCheckForEmail(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->findUserByEmail($request->input('email'))) {
            $response = array('found' => true);
        } else {
            $response = array('found' => false);
        }
        return response()->json($response);
    }

    public function ajaxCheckForPosti(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->checkPosti($request->input('idVolo'), $request->input('passengerCount'))) {
            $response = array('found' => true);
        } else {
            $response = array('found' => false);
        }
        return response()->json($response);
    }

    public function ajaxNomeAereo(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->aereoEPresente($request->input('nome'))) {
            $response = array('found' => true);
        } else {
            $response = array('found' => false);
        }
        return response()->json($response);
    }

    public function ajaxCheckAirportCode(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->codeGiaPresente($request->input('code'))) {
            $response = array('found' => true);
        } else {
            $response = array('found' => false);
        }
        return response()->json($response);
    }

    public function ajaxNomeCompagnia(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->compagniaEPresente($request->input('nome'))) {
            $response = array('found' => true);
        } else {
            $response = array('found' => false);
        }
        return response()->json($response);
    }



}
