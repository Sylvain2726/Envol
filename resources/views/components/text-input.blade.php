@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'style-none block mt-1 w-full hover:scale-105  focus:outline-none focus:ring transition-all duration-300 rounded-md focus:ring-zinc-400 focus:scale-105 bg-zinc-300 ring-offset-4  border-none form-input ']) !!}>
