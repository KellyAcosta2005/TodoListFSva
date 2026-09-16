@props(['type' => 'button'])

<button type="{{ $type }}" {{ $attributes->merge([
    'class' => 'rounded bg-indigo-600 px-4 py-2 text-white'
]) }}>
    {{ $slot }}
</button>