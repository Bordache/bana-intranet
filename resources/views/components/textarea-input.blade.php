
@props(['disabled' => false])

@php
    $classes = 'mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';

    // Ajoute la classe 'is-invalid' si des erreurs existent pour le champ
    if ($errors->has($attributes->get('name'))) {
        $classes .= ' is-invalid';
    }
@endphp

<textarea @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</textarea>

