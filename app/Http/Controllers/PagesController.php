<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class PagesController extends Controller
{


    public function home()
    {
        return view('home');
    }

    public function saludo($nombre = "Invitado")
    {
        $html = "<h2>Contenido html</h2>";
        $script = "<script> alert('Problema XSS')</script>";
        $consolas = [
            "Play Station 4",
            "Xbox One",
            "Wii"
        ];

        return view('saludo', compact('nombre', 'html', 'script', 'consolas'));
    }
}
