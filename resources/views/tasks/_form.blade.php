<label>Título <input name="title" value="{{ old('title', $task?->title) }}"></label>
@error('title')
    <p class="error">{{ $message }}</p>
@enderror

<label>Descripción <input name="description" value="{{ old('description', $task?->description) }}"></label>
@error('description')
    <p class="error">{{ $message }}</p>
@enderror

<label>Responsable
    <select name="manager_id">
        <option value="" selected disabled>Seleccione un Responsable</option>
        @foreach ($managers as $manager)
            <option value="{{ $manager->id }}" @selected(old('manager_id', $task?->manager_id) == $manager->id)>{{ $manager->name }}</option>
        @endforeach
    </select>
</label>
@error('manager_id')
    <p class="error">{{ $message }}</p>
@enderror

<label><input type="checkbox" name="completed" value="1" @checked(old('completed', $task?->completed))> Completada</label>

<button>{{ $button }}</button>