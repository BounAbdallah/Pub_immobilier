@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Demandes Reçues</h2>

        @if($demandes->isEmpty())
            <p class="text-gray-600">Vous n'avez reçu aucune demande pour le moment.</p>
        @else
            <table class="w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-gray-600">Nom du Client</th>
                        <th class="py-3 px-4 text-left text-gray-600">Message</th>
                        <th class="py-3 px-4 text-left text-gray-600">Date</th>
                        <th class="py-3 px-4 text-center text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $demande->client->nom ?? 'Anonyme' }}</td>
                            <td class="py-3 px-4 truncate">{{ \Illuminate\Support\Str::limit($demande->message, 50) }}</td>
                            <td class="py-3 px-4">{{ $demande->created_at->format('d/m/Y') }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('agent.demandes.show', $demande->id) }}" class="text-blue-500 hover:underline">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
