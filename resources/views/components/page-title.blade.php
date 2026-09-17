@props(['title', 'subtitle' => null])
<div {{ $attributes }}>
    <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
    @if ($subtitle)
        <p class="mt-1 text-sm text-gray-600">{{ $subtitle }}</p>
    @endif
</div>