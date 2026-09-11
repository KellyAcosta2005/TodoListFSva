<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    @include('tasks._form', ['task' => null, 'managers' => $managers, 'button' => 'Guardar'])
</form>