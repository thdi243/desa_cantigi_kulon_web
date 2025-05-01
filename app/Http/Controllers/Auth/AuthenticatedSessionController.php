<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        // cek dulu role_id nya
        $user = $request->only('email', 'password');

        $user = Auth::guard('web')->attempt($user);
        if ($user) {
            $user = Auth::guard('web')->user();
            if ($user->role_id == 1) {
                return redirect('/admin');
            } elseif ($user->role_id == 2) {
                return redirect()->route('home');
            } else {
                return redirect()->route('home');
            }
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();

        if ($user && $user->role_id == 1) {
            Auth::guard('web')->logout();
            return redirect('/admin/login');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
