@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Tableau de bord de l'administrateur</h1>

        <div class="flex flex-col md:flex-row md:gap-8 mt-8 space-y-8 md:space-y-0">
            <!-- Gestion des utilisateurs -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center p-6">
                <i class="fas fa-users fa-4x text-indigo-600 mb-4"></i>
                <a href="{{ route('admin.users.index') }}" class="text-lg font-semibold text-gray-800 hover:text-indigo-600">
                    Gérer les utilisateurs
                </a>
            </div>

            <!-- Voir les statistiques -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center p-6">
                <i class="fas fa-chart-line fa-4x text-green-600 mb-4"></i>
                <a href="{{ route('admin.statistiques') }}" class="text-lg font-semibold text-gray-800 hover:text-green-600">
                    Voir les statistiques
                </a>
            </div>

            <!-- Gestion des annonces -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center p-6">
                <i class="fas fa-bullhorn fa-4x text-yellow-600 mb-4"></i>
                <a href="{{ route('admin.annonces.index') }}" class="text-lg font-semibold text-gray-800 hover:text-yellow-600">
                    Gérer les annonces
                </a>
            </div>
        </div>
    </div>
@endsection
