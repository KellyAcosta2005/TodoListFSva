<div {{ $attributes->class([
    'rounded-lg border p-4',
    'border-red-300 bg-red-50 text-red-800' => $type === 'error',
    'border-blue-300 bg-blue-50 text-blue-800' => $type === 'info',
]) }}>
    <strong>{{ $title }}</strong>
    <div>{{ $slot }}</div>
</div>