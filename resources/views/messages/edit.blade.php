@extends('layout')

@section('contenido')
    <h1>Editar mensaje</h1>
    <form method="POST" action="{{ route('mensajes.update', $message->id) }}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        <p><label for="nombre">
        Nombre 
        <input  class="form-control" type="text" name="nombre" value="{{ $message->nombre }}">
        {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="email">
        Email 
        <input  class="form-control" type="text" name="email" value="{{  $message->email  }}">
        {!! $errors->first('email', '<span class=error>:message</span>') !!}
        </label></p>
        <p><label for="mensaje">
        Mensaje 
        <textarea  class="form-control" name="mensaje">{{  $message->mensaje  }}</textarea>
        {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
        </label></p>
        <input class="btn btn-primary" type="submit" value="Enviar">    
    </form>
@stop