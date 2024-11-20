<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord - Client') }}
        </h2>
    </x-slot>

    <!-- Section du tableau de bord -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Bienvenue sur votre tableau de bord, ") . Auth::user()->nom }} !
                </div>
            </div>

            <!-- Boutons pour la navigation -->
            <div class="mt-6 flex space-x-4">
                <!-- Voir les annonces -->
                <a href="{{ route('client.annonces.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
                    <i class="fas fa-list"></i> Voir les annonces
                </a>

                <!-- Faire une demande -->
                <a href="{{ route('client.demandes.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600">
                    <i class="fas fa-envelope"></i> Faire une demande
                </a>
            </div>
        </div>
    </div>

    <!-- Section des annonces -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Annonces récentes</h3>

                    <!-- Vérification de l'existence des annonces -->
                    @if($annonces->isEmpty())
                        <p class="text-gray-600">Aucune annonce disponible pour le moment.</p>
                    @else
                        <table class="w-full bg-white shadow rounded-lg overflow-hidden">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-4 text-left text-gray-600">Titre</th>
                                    <th class="py-3 px-4 text-left text-gray-600">Description</th>
                                    <th class="py-3 px-4 text-left text-gray-600">Prix</th>
                                    <th class="py-3 px-4 text-center text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($annonces as $annonce)
                                    <tr class="border-b">
                                        <td class="py-3 px-4">{{ $annonce->titre }}</td>
                                        <td class="py-3 px-4 truncate">{{ \Illuminate\Support\Str::limit($annonce->description, 50) }}</td>
                                        <td class="py-3 px-4">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</td>
                                        <td class="py-3 px-4 text-center">
                                            <a href="{{ route('client.annonces.show', $annonce->id) }}" class="text-blue-500 hover:underline">
                                                Voir les détails
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
