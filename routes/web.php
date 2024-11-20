<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Admin\AnnonceController as AdminAnnonceController;
use App\Http\Controllers\Admin\StatistiqueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route de dashboard (page principale)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes d'inscription pour chaque type d'utilisateur
Route::middleware('guest')->group(function () {
    Route::get('register/client', [RegisteredUserController::class, 'createClient'])->name('register.client');
    Route::post('register/client', [RegisteredUserController::class, 'createClient'])->name('register.client.store');
    
    Route::get('register/admin', [RegisteredUserController::class, 'createAdmin'])->name('register.admin');
    Route::post('register/admin', [RegisteredUserController::class, 'registerAdmin'])->name('register.admin.store');
    
    Route::get('register/agent', [RegisteredUserController::class, 'createAgent'])->name('register.agent');
    Route::post('register/agent', [RegisteredUserController::class, 'registerAgent'])->name('register.agent.store');
});

// Routes après authentification
Route::middleware('auth')->group(function () {
    // Tableau de bord du client
    Route::get('client/dashboard', [ClientController::class, 'indexAnnonces'])->name('client.dashboard');

    // Formulaire de contact pour les clients
    Route::prefix('client/demandes')->name('client.demandes.')->group(function () {
        Route::get('create', [DemandeController::class, 'create'])->name('create');
        Route::post('store', [DemandeController::class, 'store'])->name('store');
    });

    // Gestion des annonces pour les clients
    Route::prefix('client/annonces')->name('client.annonces.')->group(function () {
        Route::get('/', [ClientController::class, 'indexAnnonces'])->name('index');
        Route::get('{annonce}', [ClientController::class, 'showAnnonce'])->name('show');
    });

    // Tableau de bord de l'agent
    Route::get('agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');

    // Gestion des annonces pour les agents
    Route::prefix('agent/annonces')->name('agent.annonces.')->group(function () {
        Route::get('/', [AnnonceController::class, 'index'])->name('index');
        Route::get('create', [AnnonceController::class, 'create'])->name('create');
        Route::post('/', [AnnonceController::class, 'store'])->name('store');
        Route::get('{annonce}/edit', [AnnonceController::class, 'edit'])->name('edit');
        Route::put('{annonce}', [AnnonceController::class, 'update'])->name('update');
        Route::delete('{annonce}', [AnnonceController::class, 'destroy'])->name('destroy');
    });

    // Gestion des demandes pour les agents
    Route::prefix('agent/demandes')->name('agent.demandes.')->group(function () {
        Route::get('/', [DemandeController::class, 'index'])->name('index');
        Route::get('create', [DemandeController::class, 'create'])->name('create');
        Route::post('/', [DemandeController::class, 'store'])->name('store');
        Route::get('{demande}/edit', [DemandeController::class, 'edit'])->name('edit');
        Route::put('{demande}', [DemandeController::class, 'update'])->name('update');
        Route::delete('{demande}', [DemandeController::class, 'destroy'])->name('destroy');
    });

    // Tableau de bord de l'administrateur
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Gestion des utilisateurs par l'admin
   Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [AdminController::class, 'indexUsers'])->name('index'); // Liste des utilisateurs
    Route::get('{user}/edit', [AdminController::class, 'edit'])->name('edit'); // Formulaire d'édition
    Route::put('{user}', [AdminController::class, 'update'])->name('update'); // Mise à jour de l'utilisateur
    Route::delete('{user}', [AdminController::class, 'destroy'])->name('destroy'); // Suppression de l'utilisateur
    Route::put('{user}/role', [AdminController::class, 'updateUserRole'])->name('updateRole'); // Mise à jour du rôle
});


    // Gestion des annonces par l'admin
   // Routes pour les annonces administrateurs
// Routes pour la gestion des annonces par l'admin
Route::prefix('admin/annonces')->name('admin.annonces.')->group(function () {
    Route::get('/', [AnnonceController::class, 'index'])->name('index');
    Route::get('create', [AnnonceController::class, 'create'])->name('create');
    Route::post('/', [AnnonceController::class, 'store'])->name('store');
    Route::get('{annonce}/edit', [AnnonceController::class, 'edit'])->name('edit');
    Route::put('{annonce}', [AnnonceController::class, 'update'])->name('update');
    Route::delete('{annonce}', [AnnonceController::class, 'destroy'])->name('destroy');
});



    // Statistiques de la plateforme
    Route::get('admin/statistiques', [AdminController::class, 'showStatistiques'])->name('admin.statistiques');
});

// Routes de profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentification
require __DIR__ . '/auth.php';
