@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Annonces disponibles</h1>

        @if($annonces->isEmpty())
            <p>Aucune annonce disponible pour le moment.</p>
        @else
            <div class="row">
                @foreach($annonces as $annonce)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset(str_replace('public', 'storage', json_decode($annonce->images_path)[0] ?? 'images/default.jpg')) }}" class="card-img-top" alt="Image de l'annonce">
                            <div class="card-body">
                                <h5 class="card-title">{{ $annonce->titre }}</h5>
                                <p class="card-text">
                                    <strong>Prix :</strong> {{ $annonce->prix }} FCFA<br>
                                    <strong>Localisation :</strong> {{ $annonce->localisation }}<br>
                                    {{ Str::limit($annonce->description, 100) }}
                                </p>
                                <a href="#" class="btn btn-primary">Voir plus</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
