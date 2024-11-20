@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-semibold text-gray-800">Mes Annonces</h2>

        <table class="w-full mt-6">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-2 px-4">Titre</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annonces as $annonce)
                    <tr>
                        <td class="py-2 px-4">{{ $annonce->title }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('agent.annonces.edit', $annonce->id) }}" class="text-blue-500">Modifier</a>
                            <form action="{{ route('agent.annonces.destroy', $annonce->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
