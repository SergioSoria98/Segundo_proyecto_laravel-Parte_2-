<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .active{
            text-decoration: none;
            color: green;
        }
        .error{
            color: red;
            font-size: 12px;
        }
    </style>
    <title>Mi sitio</title>
</head>
<body>
    <header>
    <?php function activeMenu($url){
        return request()->is($url) ? 'active': '';
    } ?>

        <nav>
            <a class="{{ activeMenu('/') }}" href="{{ route('home') }}">Inicio</a>
            <a class="{{ activeMenu('saludos*') }}" href="{{ route('saludos', 'Sergio') }}">Saludo</a>
            <a class="{{ activeMenu('mensajes/create') }}" href="{{ route('mensajes.create') }}">Contactos</a>
            
            @if (auth()->check())
            <a class="{{ activeMenu('mensajes') }}" href="{{ route('mensajes.index') }}">Mensajes</a>
                <a href="/logout">Cerrar sesión de {{ auth()->user()->name }}</a>
            @endif
            
            @if (auth()->guest())
                <a class="{{ activeMenu('login') }}" href="/login">Login</a>
            @endif
        </nav>
    </header>
    @yield('contenido')
    <footer>Copyright {{ date('Y') }}</footer>
</body>
</html>