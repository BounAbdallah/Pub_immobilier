<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen bg-gray-100">
        <!-- Barre de navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center text-blue-300">
                            <i class="fas fa-building text-3xl"></i>
                        </a>
                    </div>

                    <!-- Menu de navigation -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}" class="text-blue-300 hover:text-blue-500 font-semibold">
                            Accueil
                        </a>
                        <a href="{{ route('agent.annonces.index') }}" class="text-blue-300 hover:text-blue-500 font-semibold">
                            Annonces
                        </a>
                        <a href="{{ route('client.demandes.create') }}" class="text-blue-300 hover:text-blue-500 font-semibold">
                            Contact
                        </a>
                    </div>

                    <!-- Afficher le nom de l'utilisateur connecté et bouton de déconnexion -->
                    <div class="hidden md:flex items-center space-x-4 text-blue-300">
                        <!-- Affiche le nom de l'utilisateur connecté -->
                        @auth
                            <span>{{ Auth::user()->name }}</span>
                        @endauth

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts supplémentaires -->
    @stack('scripts')
</body>

</html>
