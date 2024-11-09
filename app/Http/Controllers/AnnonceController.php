<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;

use function Termwind\render;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces = Annonce::all();

        return view('annonces.index', [

            'annonces' => $annonces,
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // Validation des données d'entrée
        $validatedData = $request->validate([
            'image' => 'nullable|string',
            'titre' => 'required|string|max:255',
            'description' => 'required|text',
            'prix' => 'required|decimal',
            'localisation' => 'required|string',

        ]);
        $annonces = Annonce::all();


        return view('annonoces', [

            'annonces' => $annonces,
            'user' => Auth::user()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnonceRequest $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
