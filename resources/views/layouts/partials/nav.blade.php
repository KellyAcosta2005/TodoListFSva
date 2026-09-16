<nav class="bg-gray-900 text-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold">
                    Mi Laravel
                </a>
            </div>

            {{-- Links --}}
            <div class="hidden md:flex items-center gap-6">
                <a 
                    href="{{ route('home') }}" 
                    class="{{ request()->routeIs('home') ? 'text-blue-400' : 'hover:text-gray-300' }}"
                >
                    Inicio
                </a>

                <a 
                    href="{{ route('tasks.index') }}" 
                    class="{{ request()->routeIs('tasks.index') ? 'text-blue-400' : 'hover:text-gray-300' }}"
                >
                    Tasks
                </a>

                <a 
                    href="{{ route('managers.index') }}" 
                    class="{{ request()->routeIs('managers.index') ? 'text-blue-400' : 'hover:text-gray-300' }}"
                >
                    Managers
                </a>
            </div>

            {{-- Usuario --}}
            <div class="flex items-center gap-4">
                @auth
                    <span>{{ auth()->user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button 
                            type="submit" 
                            class="rounded bg-red-600 px-3 py-2 text-sm hover:bg-red-700"
                        >
                            Salir
                        </button>
                    </form>
                @else
                    <a 
                        href="{{ route('login') }}" 
                        class="rounded bg-blue-600 px-3 py-2 text-sm hover:bg-blue-700"
                    >
                        Iniciar sesión
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>