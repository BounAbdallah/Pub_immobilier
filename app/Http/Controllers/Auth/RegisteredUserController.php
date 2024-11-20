<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\CustomeLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming client registration request.
     */
    public function createClient(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Client');
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('client.dashboard');
    }

    /**
     * Display the admin registration view.
     */
    public function createAdmin(): View
    {
        return view('auth.admin.register');
    }

    /**
     * Handle an incoming admin registration request.
     */
    public function registerAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Admin');
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the agent registration view.
     */
    public function createAgent(): View
    {
        return view('auth.agent.register');
    }

    /**
     * Handle an incoming agent registration request.
     */
    public function registerAgent(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'numero' => $request->numero,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Agent');
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('agent.dashboard');
    }
}
