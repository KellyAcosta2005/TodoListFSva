@extends('layouts.app')

@section('title', 'Detalle de tarea')

@section('content')
    <h2>{{ $task->title }}</h2>
    <p>{{ $task->description ?? 'Sin descripción' }}</p>
    <p>Estado: {{ $task->completed ? 'Completada' : 'Pendiente' }}</p>
    <p>Responsable: {{ $task->manager->name }}</p>

    <a href="{{ route('tasks.index') }}">Volver</a>
@endsection
