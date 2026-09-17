<x-app-layout>
    <x-slot name="header">
        <x-page-title 
            title="Responsables" 
            subtitle="Personas asignables a las tareas" 
        />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            <x-status-message />

            <div class="flex justify-end">
                <a href="{{ route('managers.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">
                    Nuevo Responsable
                </a>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($managers as $manager)
                    <x-card :title="$manager->name">
                        {{ $manager->email }}
                        <p>{{ $manager->tasks_count }} tareas</p>
                        <div class="mt-4 flex items-center gap-3 border-t border-gray-200 pt-4">
                            <a href="{{ route('managers.edit', $manager) }}" class="text-indigo-600 hover:text-indigo-900">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('managers.destroy', $manager) }}"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este responsable?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </x-card>
                @empty
                    <p>Todavía no hay responsables.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>