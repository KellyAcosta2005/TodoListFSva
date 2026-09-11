<label>Nombre <input name="name" value="{{ old('name', $manager?->name) }}"></label>
@error('name')
    <p class="error">{{ $message }}</p>
@enderror

<label>Email <input name="email" value="{{ old('email', $manager?->email) }}"></label>
@error('email')
    <p class="error">{{ $message }}</p>
@enderror

<button>{{ $button }}</button>