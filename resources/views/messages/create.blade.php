@extends('layout')

@section('contenido')
<h1>Contactos</h1>
<h2>Escribeme</h2>
@if( session()->has('info') )
    <h3>{{ session('info') }}</h3>
@else
    <form method="POST" action="{{ route('mensajes.store') }}">
        @include('messages.form', [
            'message' => new App\Models\Message,
            'showFields' => auth()->guest()
            ]) 
    </form>
@endif
<hr>
@stop