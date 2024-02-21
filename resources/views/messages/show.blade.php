@extends('layout')

@section('contenido')
    <h1>Mensaje</h1>
    <p>Enviador por {{ $message->nombre }} - {{ $message->email }}</p>
    <p>{{ $message->mensaje }}</p>
@stop