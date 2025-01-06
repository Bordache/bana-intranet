@props(['disabled' => false])

@php
    $classes = 'form-control border-gray-300 rounded-md';
    if ($attributes->get('type') === 'date' || $attributes->get('type') === 'number') {
        $classes .= ' w-auto';
    }
@endphp

<input @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>
