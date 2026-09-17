<x-app-layout>
    <x-slot name="header">
        <x-page-title title="Editar tarea" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form-section :action="route('tasks.update', $task)">
                <x-slot name="title">Información de la tarea</x-slot>
                <x-slot name="description">Actualiza los datos, el responsable y el estado de la tarea.</x-slot>

                <x-slot name="form">
                    @csrf
                    @method('PUT')

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="title" value="Título" />
                        <x-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title)" required minlength="3" maxlength="255" />
                        <x-input-error for="title" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="description" value="Descripción" />
                        <x-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $task->description)" maxlength="400" />
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="manager_id" value="Responsable" />
                        <select id="manager_id" name="manager_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="" disabled @selected(! old('manager_id', $task->manager_id))>Seleccione un Responsable</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}" @selected(old('manager_id', $task->manager_id) == $manager->id)>{{ $manager->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="manager_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <input type="hidden" name="completed" value="0">
                        <label for="completed" class="flex items-center gap-2">
                            <x-checkbox id="completed" name="completed" value="1" :checked="(bool) old('completed', $task->completed)" />
                            <span class="text-sm text-gray-600">Completada</span>
                        </label>
                        <x-input-error for="completed" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('tasks.index') }}" class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancelar</a>
                        <x-button>Actualizar</x-button>
                    </div>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</x-app-layout>
