<x-app-layout>
    <x-slot name="header">
        <x-page-title title="Editar responsable" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-form-section :action="route('managers.update', $manager)">
                <x-slot name="title">Información del responsable</x-slot>
                <x-slot name="description">Actualiza el nombre y el correo electrónico del responsable.</x-slot>

                <x-slot name="form">
                    @csrf
                    @method('PUT')

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="name" value="Nombre" />
                        <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $manager->name)" required minlength="3" maxlength="60" autocomplete="name" />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="email" value="Email" />
                        <x-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $manager->email)" required maxlength="255" autocomplete="email" />
                        <x-input-error for="email" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('managers.index') }}" class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancelar</a>
                        <x-button>Actualizar</x-button>
                    </div>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</x-app-layout>
