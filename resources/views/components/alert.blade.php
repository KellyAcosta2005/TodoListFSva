<div {{ $attributes->class([
    'rounded-lg border p-4',
    'border-red-300 bg-red-50 text-red-800' => $type === 'error',
    'border-blue-300 bg-blue-50 text-blue-800' => $type === 'info',
    'border-yellow-300 bg-yellow-50 text-yellow-800' => $type === 'warning',
]) }}>
    <strong>{{ $title }}</strong>
    <div>{{ $slot }}</div>
</div>