<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function getHome()
    {
        session_start();


        return view('index');
    }

    public function ChiSiamo()
    {
        //session_start();
        return view('altro.who');
    }

    public function privacy()
    {
        //session_start();
        return view('altro.privacy');
    }

    public function terms()
    {
        //session_start();
        return view('altro.terms');
    }




}
