<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'npm' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['npm' => $credentials['npm'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return redirect()->intended('arsips');
        }

        return back()->withErrors([
            'npm' => 'NPM atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
