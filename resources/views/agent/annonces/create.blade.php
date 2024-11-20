@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800">Créer une Annonce</h2>

        <form action="{{ route('agent.annonces.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="titre" class="block text-gray-700">Titre</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required class="w-full p-3 border border-gray-300 rounded-md" />
                @error('titre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" required class="w-full p-3 border border-gray-300 rounded-md" rows="4">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="prix" class="block text-gray-700">Prix</label>
                <input type="number" id="prix" name="prix" value="{{ old('prix') }}" required class="w-full p-3 border border-gray-300 rounded-md" step="0.01" />
                @error('prix') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="localisation" class="block text-gray-700">Localisation</label>
                <input type="text" id="localisation" name="localisation" value="{{ old('localisation') }}" required class="w-full p-3 border border-gray-300 rounded-md" />
                @error('localisation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="latitude" class="block text-gray-700">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" required class="w-full p-3 border border-gray-300 rounded-md" />
                @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="longitude" class="block text-gray-700">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" required class="w-full p-3 border border-gray-300 rounded-md" />
                @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="images" class="block text-gray-700">Images</label>
                <input type="file" id="images" name="images[]" accept="image/*" class="w-full p-3 border border-gray-300 rounded-md" multiple />
                @error('images') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md">Publier</button>
        </form>
    </div>
@endsection
