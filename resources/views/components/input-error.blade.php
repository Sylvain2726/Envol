@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-md text-red-500 rounded-xl space-y-1 bg-zinc-100/30 px-2 py-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
