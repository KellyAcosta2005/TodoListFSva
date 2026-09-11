<form method="POST" action="{{ route('managers.store') }}">
    @csrf
    @include('managers._form', ['manager' => null, 'button' => 'Guardar'])
</form>