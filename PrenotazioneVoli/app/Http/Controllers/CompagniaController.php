<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CompagniaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $compagnie = $dl->listCompagnie();
        return view('compagnie.index')->with('compagnie', $compagnie);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('compagnie.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nome = $request->input('nome');
        $sede = $request->input('city');
        $country = $request->input('country');
        $anno_fondazione = $request->input('anno');

        $dl = new DataLayer();
        $dl->addCompagnia($nome, $sede, $country, $anno_fondazione);

        return Redirect::to(route('compagnie.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $company = $dl->findCompagniaById($id);
        if ($company == null) {
            return view('errors.404')->with('message', 'Wrong compagnia ID has been used!');
        } else {
            return view('compagnie.show')->with('compagnia', $company);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $company = $dl->findCompagniaById($id);
        if ($company == null) {
            return view('errors.404')->with('message', 'Wrong compagnia ID has been used!');
        } else {
            return view('compagnie.edit')->with('compagnia', $company);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nome = $request->input('nome');
        $sede = $request->input('city');
        $country = $request->input('country');
        $anno_fondazione = $request->input('anno');


        $dl = new DataLayer();
        $dl->editCompagnia($id, $nome, $sede, $country, $anno_fondazione);

        return Redirect::to(route('compagnie.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dl = new DataLayer();
        $dl->deleteCompagnia($id);
        return Redirect::to(route('compagnie.index'));
    }

    public function confirmDestroy(string $id)
    {
        $dl = new DataLayer();
        $company = $dl->findCompagniaById($id);
        if ($company !== null) {
            if ($company->voli->count() > 0) {
                return view('errors.titolo')->with('message', 'Cannot delete a company with flights!');
            } else {
                return view('compagnie.delete')->with('compagnia', $company);
            }
        } else {
            return view('errors.404')->with('message', 'Wrong compagnia ID has been used!');
        }
    }



}
