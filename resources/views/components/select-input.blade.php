@props(['disabled' => false])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'form-select border-gray-300 rounded-md w-auto']) }}>
    {{ $slot }}
</select>
