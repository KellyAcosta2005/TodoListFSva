@props(['title'])
<section {{ $attributes->merge(['class' => 'rounded border p-4']) }}>
    <h3>{{ $title }}</h3>
    <div>{{ $slot }}</div>
</section>