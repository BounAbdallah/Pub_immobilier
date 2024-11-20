@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800">Modifier l'Annonce</h2>

        <form action="{{ route('agent.annonces.update', $annonce->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titre</label>
                <input type="text" id="title" name="title" value="{{ $annonce->title }}" required class="w-full p-3 border border-gray-300 rounded-md" />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" required class="w-full p-3 border border-gray-300 rounded-md" rows="4">{{ $annonce->description }}</textarea>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md">Mettre à jour</button>
        </form>
    </div>
@endsection
