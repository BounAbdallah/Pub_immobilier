<?php
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes d'inscription pour chaque type d'utilisateur
Route::middleware('guest')->group(function () {
    // Formulaire et traitement de l'inscription du client
    Route::get('register/client', [RegisteredUserController::class, 'createClient'])->name('register.client');
    Route::post('register/client', [RegisteredUserController::class, 'createClient'])->name('register.client.store');
    
    // Formulaire et traitement de l'inscription de l'admin
    Route::get('register/admin', [RegisteredUserController::class, 'createAdmin'])->name('register.admin');
    Route::post('register/admin', [RegisteredUserController::class, 'registerAdmin'])->name('register.admin.store');
    
    // Formulaire et traitement de l'inscription de l'agent
    Route::get('register/agent', [RegisteredUserController::class, 'createAgent'])->name('register.agent');
    Route::post('register/agent', [RegisteredUserController::class, 'registerAgent'])->name('register.agent.store');
});

// Tableau de bord du client
Route::middleware('auth')->group(function () {
    Route::get('client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
});

// Tableau de bord de l'agent
Route::middleware('auth')->group(function () {
    Route::get('agent/dashboard', function () {
        return view('agent.dashboard');
    })->name('agent.dashboard');
});

// Tableau de bord de l'administrateur
Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Routes de profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
