<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function PHPUnit\Framework\isEmpty;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();


        $user = Auth::user();
        // Vérifie si l'utilisateur a au moins un rôle
        if ($user->roles->count() === 0) {
            // Déconnecte l'utilisateur
            Auth::logout();

            // Redirige vers la page de connexion avec un message d'erreur
            return redirect()->route('login')->with(['error' => 'Vous devez attendre une autorisation d\'accès pour vous connecter']);
        }

        $user = User::where('id', $user->id)->update([
            'status' => true
        ]);

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user = User::where('id', $user->id)->update([
            'status' => false
        ]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/');
    }
}
