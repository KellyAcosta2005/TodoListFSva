@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="mx-auto max-w-md px-4 py-10">
        <h1 class="mb-6 text-2xl font-bold">Iniciar sesión</h1>

        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 p-3 text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded border border-gray-300 px-3 py-2">
            </div>

            <div>
                <label for="password" class="mb-1 block">Contraseña</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded border border-gray-300 px-3 py-2">
            </div>

            <label class="flex items-center gap-2">
                <input name="remember" type="checkbox" value="1">
                Recordarme
            </label>

            <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                Iniciar sesión
            </button>
        </form>
    </div>
@endsection
