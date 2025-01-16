@props(['disabled' => false])

@php
    $classes = 'form-select border-gray-300 rounded-md w-auto';

    // Ajoute la classe 'is-invalid' si des erreurs existent pour le champ
    if ($errors->has($attributes->get('name'))) {
        $classes .= ' is-invalid';
    }
@endphp

<select @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</select>
