<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('index'); // Asegúrate de que el nombre del archivo Blade coincida
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        dd($credentials); // Para depuración, eliminar después de la prueba

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home'); // Asegúrate de que la ruta sea correcta
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
