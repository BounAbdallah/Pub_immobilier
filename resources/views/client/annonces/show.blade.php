@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800">Détails de la Demande</h2>

        <p class="mt-4 text-gray-700">{{ $demande->message }}</p>
    </div>
@endsection
