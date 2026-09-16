@props(['title'])
<details class="rounded border p-3">
    <summary>{{ $title }}</summary>
    <div>{{ $slot }}</div>
</details>