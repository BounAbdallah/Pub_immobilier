<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::where('user_id', Auth::id())->get(); // Annonces de l'agent connecté
        return view('agent.annonces.index', compact('annonces'));
    }

    public function create()
    {
        return view('agent.annonces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'localisation' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagesPath = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $imagesPath[] = $path;
            }
        }

        Annonce::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'localisation' => $request->localisation,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images_path' => json_encode($imagesPath),
        ]);

        return redirect()->route('agent.annonces.index');
    }

    public function edit(Annonce $annonce)
    {
        return view('agent.annonces.edit', compact('annonce'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'localisation' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagesPath = json_decode($annonce->images_path, true) ?: [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $imagesPath[] = $path;
            }
        }

        $annonce->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'localisation' => $request->localisation,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images_path' => json_encode($imagesPath),
        ]);

        return redirect()->route('agent.annonces.index');
    }

    public function destroy(Annonce $annonce)
    {
        $annonce->delete();
        return redirect()->route('agent.annonces.index');
    }
}
