<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AereoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $aerei = $dl->listAerei();

        return view('aerei.index')->with('aerei', $aerei);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aerei.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addAereo($request->input('nome'), $request->input('posti'));

        return redirect()->route('aerei.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deleteAereo($id);
        return Redirect::to(route('aerei.index'));
    }

    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $aereo = $dl->findAereoById($id);
        if ($aereo !== null) {
            return view('aerei.delete')->with('aereo', $aereo);
        } else {
            return view('errors.404')->with('message', 'Wrong aereo ID has been used!');
        }
    }
}
