<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Mi TodoList')</title>
    @stack('styles')
</head>
<body>
    @include('layouts.partials.nav')

    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Mi TodoList. Todos los derechos reservados.</p>
    </footer>
    @stack('scripts')
</body>
</html>