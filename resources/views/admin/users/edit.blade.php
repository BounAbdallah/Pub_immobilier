@extends('layouts.app')

@section('content')
    <h1>Modifier l'utilisateur</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom', $user->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role" class="form-control">
                <option value="admin" {{ old('role', $user->getRoleNames()->first()) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                <option value="agent" {{ old('role', $user->getRoleNames()->first()) == 'agent' ? 'selected' : '' }}>Agent</option>
                <option value="client" {{ old('role', $user->getRoleNames()->first()) == 'client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour l'utilisateur</button>
    </form>
@endsection
