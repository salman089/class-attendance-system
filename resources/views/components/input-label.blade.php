@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-white']) }}>
    {{ $value ?? $slot }}
</label>
