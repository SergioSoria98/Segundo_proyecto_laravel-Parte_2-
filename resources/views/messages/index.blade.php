@extends('layout')

@section('contenido')

    <h1>Todos los mensajes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Notas</th>
                <th>Etiquetas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    @if ($message->user_id)
                        <td>
                            <a href="{{ route('usuarios.show', $message->user_id) }}">
                                {{ $message->user->name }}
                            </a>
                        </td>
                        <td>{{ $message->user->email }}</td>
                    @else
                        <td>{{ $message->nombre }}</td>
                        <td>{{ $message->email }}</td>
                    @endif
                    <td>
                        <a href="{{ route('mensajes.show', $message->id) }}">{{ $message->mensaje }}</a>
                    </td>

                    @if ($message->note)
                        <td>{{ $message->note->body }}</td>
                    @else
                        <td>No hay nota asociada</td>
                    @endif


                    @if ($message->tags)
                        <td>{{ $message->tags->pluck('name')->implode(', ') }}</td>
                    @else
                        <td>No hay tag asociado</td>
                    @endif




                    <td>
                        <a class="btn btn-info" href="{{ route('mensajes.edit', $message->id) }}">Editar</a>
                        <form style="display:inline" method="POST" action="{{ route('mensajes.destroy', $message->id) }}">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach


{!! $messages->fragment('hash')->appends(request()->query())->links('pagination::bootstrap-4', ['showInfo' => false]) !!}

        </tbody>
    </table>
@stop