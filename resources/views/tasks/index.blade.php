@extends('layouts.app')

@section('title', 'Tareas')

@section('content')
{{-- 
<x-modal>
    <x-slot:header><h3>Eliminar tarea</h3></x-slot:header>
    Esta acción no se puede deshacer.
    <x-slot:footer><button>Cancelar</button></x-slot:footer>
</x-modal>

<x-card title="Información importante" class="mt-4">
    Esta tarea tiene un responsable asignado.
</x-card> 

<x-alert type='error' title="Un error" class='mb-4'>
    Esto es dentro del slot revisa el error
</x-alert>--}}

<x-accordion>
    <x-accordion-item title="Pendientes">3 tareas</x-accordion-item>
    <x-accordion-item title="Completadas">8 tareas</x-accordion-item>
</x-accordion>

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

@push('scripts')
        <script>console.log('vista cargada en tareas')</script>
@endpush