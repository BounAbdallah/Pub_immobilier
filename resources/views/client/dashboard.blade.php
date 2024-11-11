<h4>Hello</h4>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <!-- Lien vers la page des annonces -->
    <a href="{{ route('annonces.index') }}" class="btn btn-primary">
        Voir les annonces
    </a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <h2>Hello</h2>
            </div>
        </div>
    </div>
</x-app-layout>
