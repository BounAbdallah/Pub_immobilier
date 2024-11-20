<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::where('user_id', Auth::id())->get(); // Les demandes pour l'agent connecté
        return view('agent.demandes.index', compact('demandes'));
    }

    public function create()
    {
        return view('client.demandes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'annonce_id' => 'required|exists:annonces,id',
        ]);

        Demande::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'annonce_id' => $request->annonce_id,
        ]);

        return redirect()->route('client.demandes.index');
    }

    public function edit(Demande $demande)
    {
        return view('agent.demandes.edit', compact('demande'));
    }

    public function update(Request $request, Demande $demande)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $demande->update([
            'message' => $request->message,
        ]);

        return redirect()->route('agent.demandes.index');
    }

    public function destroy(Demande $demande)
    {
        $demande->delete();
        return redirect()->route('agent.demandes.index');
    }
}
