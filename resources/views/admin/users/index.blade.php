@extends('layouts.app')

@section('content')
    <h1 class="text-center text-primary mb-5">Gestion des utilisateurs</h1>

    <!-- Affichage du message de succès -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered shadow-sm rounded">
            <thead class="table-dark">
                <tr>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle actuel</th>
                    <th>Modifier le rôle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-info">
                                <i class="fas fa-user-circle"></i> {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                            </span>
                        </td>
                        <td>
                            <!-- Formulaire pour modifier le rôle -->
                            <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="input-group">
                                    <select name="role" class="form-select" required>
                                        <option value="Client" {{ $user->hasRole('Client') ? 'selected' : '' }}>
                                            <i class="fas fa-user"></i> Client
                                        </option>
                                        <option value="Agent" {{ $user->hasRole('Agent') ? 'selected' : '' }}>
                                            <i class="fas fa-briefcase"></i> Agent
                                        </option>
                                        <option value="Admin" {{ $user->hasRole('Admin') ? 'selected' : '' }}>
                                            <i class="fas fa-cogs"></i> Administrateur
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary ms-2">
                                        <i class="fas fa-save"></i> Mettre à jour
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a73e8;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-dark {
            background-color: #343a40;
            color: #fff;
        }

        .input-group {
            max-width: 250px;
        }

        .form-select {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            border-radius: 5px;
            padding: 10px 15px;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert-dismissible .btn-close {
            opacity: 1;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 0.9rem;
            }

            .input-group {
                flex-direction: column;
            }

            .form-select {
                width: 100%;
            }
        }

        /* Icon styling */
        .input-group i, .badge-info i {
            margin-right: 5px;
        }
    </style>

    <!-- Include Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
