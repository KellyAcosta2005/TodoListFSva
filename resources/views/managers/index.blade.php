@extends('layouts.app')

@section('title', 'Manager')

@section('content')
    <a href="{{ route('managers.create') }}">Crear</a>

    @foreach ($managers as $manager)
        <div>
            <h2>{{ $manager->name }}</h2>
            <p>{{ $manager->email }}</p>
            <a href="{{ route('managers.edit', $manager) }}">Editar</a>
            <form action="{{ route('managers.destroy', $manager) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </div>
    @endforeach
@endsection