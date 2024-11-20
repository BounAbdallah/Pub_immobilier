@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Détails de la Demande</h2>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Nom du Client :</h3>
                <p class="text-gray-600">{{ $demande->client->nom ?? 'Anonyme' }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Message :</h3>
                <p class="text-gray-600">{{ $demande->message }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Reçue le :</h3>
                <p class="text-gray-600">{{ $demande->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <a href="{{ route('agent.demandes.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Retour à la liste des demandes</a>
        </div>
    </div>
@endsection
