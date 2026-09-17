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
</x-alert>

<x-accordion>
    <x-accordion-item title="Pendientes">3 tareas</x-accordion-item>
    <x-accordion-item title="Completadas">8 tareas</x-accordion-item>
</x-accordion>--}}

<x-app-layout>
    <x-slot name="header">
        <x-page-title 
            title="Tareas" 
            subtitle="Listado de tareas y responsables" 
        />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            <x-status-message />

            <div class="flex justify-end">
                <a href="{{ route('tasks.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">
                    Nueva tarea
                </a>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">Tarea</th>
                            <th class="px-6 py-3 text-left">Responsable</th>
                            <th class="px-6 py-3 text-left">Estado</th>
                            <th class="px-6 py-3 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tasks as $task)
                            <tr>
                                <td class="px-6 py-4">{{ $task->title }}</td>
                                <td class="px-6 py-4">{{ $task->manager->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $task->completed ? 'Completada' : 'Pendiente' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center">
                                    Todavía no hay tareas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>