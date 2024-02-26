<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Método para manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si la autenticación tiene éxito, redirigir al usuario a la página deseada
            return redirect()->intended('/mensajes');
        }

        // Si la autenticación falla, redirigir de nuevo al formulario de inicio de sesión con un mensaje de error
        return back()->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.']);
    }

    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}