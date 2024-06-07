<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aereoporti;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AereoportoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $airports = $dl->listAirport();
        return view('aereoporti.index')->with('airports_list', $airports);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aereoporti.editAirport');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addAirport($request->input('nome'), $request->input('city'), $request->input('country'), $request->input('code'), $request->input('lat'), $request->input('lon'));
        return Redirect::to(route('aereoporti.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $airport = $dl->findAirportById($id);
        return view('aereoporti.show')->with('airport', $airport);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $airport = $dl->findAirportById($id);

        if ($airport !== null) {
            return view('aereoporti.editAirport')->with('airport', $airport);
        } else {
            return view('errors.404')->with('message', 'Wrong airport ID has been used!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dl = new DataLayer();
        $dl->editAirport($id, $request->input('nome'), $request->input('city'), $request->input('country'), $request->input('code'), $request->input('lat'), $request->input('lon'));
        return Redirect::to(route('aereoporti.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deleteAirport($id);
        return Redirect::to(route('aereoporti.index'));
    }
    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $airport = $dl->findAirportById($id);
        if ($airport !== null) {
            return view('aereoporti.deleteAirport')->with('airport', $airport);
        } else {
            return view('errors.404')->with('message', 'Wrong aereoporti ID has been used!');
        }
    }
}
