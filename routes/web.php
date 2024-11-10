<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
