@extends('layouts.app')

@section('title', 'Tareas')

@section('content')
    <a href="{{ route('tasks.create') }}">Crear</a>
    
    @forelse ($tasks as $task)
        <div>
            <h2>{{ $task->title }}</h2>
            <p>{{ $task->description }}</p>
            <p>{{ $task->completed ? "Completada" : "Pendiente" }}</p>
            <p>Responsable: {{ $task->manager->name }}</p>
            <a href="{{ route('tasks.edit', $task) }}">Editar</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </div>
    @empty
        <p>No hay tareas creadas.</p>
    @endforelse
@endsection