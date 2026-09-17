@session('status')
    <div {{ $attributes->merge([
        'class' => 'rounded-lg bg-green-100 p-4 text-green-800'
    ]) }}>
        {{ $value }}
    </div>
@endsession