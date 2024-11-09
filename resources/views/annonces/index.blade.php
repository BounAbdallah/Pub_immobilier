<h1>Hello</h1>

@foreach ($annonces as $annonce)
    <div>
        <h2>{{ $annonce->titre }}</h2>
        <p>{{ $annonce->description }}</p>
        <p>{{ $annonce->image }}</p>
        <p>{{ $annonce->prix }}</p>
        <p>{{ $annonce->user_id }}</p>
        <p>{{ $annonce->localisation }}</p>
    </div>
@endforeach
