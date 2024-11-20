@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Mes Annonces</h2>
    
    @if ($annonces->isEmpty())
        <p class="text-lg text-gray-600">Aucune annonce trouvée.</p>
    @else
        <!-- Bouton de création d'annonce -->
        <div class="mb-6">
            <a href="{{ route('agent.annonces.create') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300 flex items-center space-x-2">
                <!-- Icône ajouter -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Créer une nouvelle annonce</span>
            </a>
        </div>
        
        <!-- Tableau des annonces -->
        <div class="overflow-hidden bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="py-3 px-6 font-medium text-sm">Titre</th>
                        <th class="py-3 px-6 font-medium text-sm">Prix</th>
                        <th class="py-3 px-6 font-medium text-sm">Images</th>
                        <th class="py-3 px-6 font-medium text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($annonces as $annonce)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $annonce->titre }}</td>
                            <td class="py-3 px-6">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</td>
                            <td class="py-3 px-6">
                                @if($annonce->images_path)
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach(json_decode($annonce->images_path) as $image)
                                            <img src="{{ Storage::url($image) }}" alt="Image de l'annonce" class="w-16 h-16 object-cover rounded-md">
                                        @endforeach
                                    </div>
                                @else
                                    <span>Aucune image</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 space-y-2">
                                <!-- Bouton Modifier -->
                                <a href="{{ route('agent.annonces.edit', $annonce->id) }}" class="flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300">
                                    <!-- Icône modifier -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-4M16 5l3 3M9 12l7-7" />
                                    </svg>
                                    Modifier
                                </a>
                                
                                <!-- Bouton Voir les demandes -->
                                <a href="{{ route('agent.demandes.index', $annonce->id) }}" class="flex items-center text-green-600 hover:text-green-800 font-semibold transition-colors duration-300">
                                    <!-- Icône demandes -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11m-6 7v-7m8 7v-5m1-4h2.6M19 12h1.6M17 7h2.6M19 14h1.6" />
                                    </svg>
                                    Voir les demandes
                                </a>
                                
                                <!-- Formulaire de suppression -->
                                <form action="{{ route('agent.annonces.destroy', $annonce->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette annonce ?');" class="flex items-center text-red-600 hover:text-red-800 font-semibold transition-colors duration-300">
                                        <!-- Icône suppression -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12h.01M12 15h.01M9 12h.01M12 9h.01M9 9h.01M12 6h.01M9 6h.01M15 9h.01" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
