@props(['disabled' => false])

@php
    $classes = 'form-control border-gray-300 rounded-md';

    // Ajoute des classes supplémentaires en fonction du type d'entrée
    if ($attributes->get('type') === 'date' || $attributes->get('type') === 'number') {
        $classes .= ' w-auto';
    }

    // Ajoute la classe 'is-invalid' si des erreurs existent pour le champ
    if ($errors->has($attributes->get('name'))) {
        $classes .= ' is-invalid';
    }
@endphp

<input @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>

