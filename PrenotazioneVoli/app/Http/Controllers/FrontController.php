<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome()
    {
        session_start();
        return view('index');
    }

    public function ChiSiamo()
    {
        session_start();
        return view('altro.who');
    }

    public function privacy()
    {
        session_start();
        return view('altro.privacy');
    }

    public function terms()
    {
        session_start();
        return view('altro.terms');
    }




}
