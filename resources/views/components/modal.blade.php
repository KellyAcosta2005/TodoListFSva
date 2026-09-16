<div {{ $attributes->merge(['class' => 'rounded border bg-white p-6']) }}>
    <header>{{ $header }}</header>
    <main>{{ $slot }}</main>
    <footer>{{ $footer }}</footer>
</div>