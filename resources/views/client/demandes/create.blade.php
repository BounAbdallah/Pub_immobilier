@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800">Formulaire de Contact</h2>
        
        @if(session('message'))
            <div class="bg-green-500 text-white p-4 mb-6 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('client.demandes.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full p-3 border border-gray-300 rounded-md" />
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full p-3 border border-gray-300 rounded-md" />
                @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea id="message" name="message" required class="w-full p-3 border border-gray-300 rounded-md" rows="4">{{ old('message') }}</textarea>
                @error('message') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md">Envoyer</button>
        </form>
    </div>
@endsection
