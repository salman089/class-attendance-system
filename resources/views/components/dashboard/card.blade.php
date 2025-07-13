@props(['title', 'value', 'icon' => null, 'color' => 'gray'])

@php
    $colorClasses = [
        'blue' => 'text-blue-400',
        'green' => 'text-green-400',
        'indigo' => 'text-indigo-400',
        'purple' => 'text-purple-400',
        'yellow' => 'text-yellow-400',
        'red' => 'text-red-400',
        'gray' => 'text-gray-400',
    ];

    $iconColor = $colorClasses[$color] ?? 'text-white';
@endphp

<div class="p-4 text-center bg-[#2e2b2b] hover:bg-[#555151] rounded-lg shadow transition duration-300 ease-in-out">
    @if ($icon)
        <div class="mb-2 text-3xl {{ $iconColor }}">
            <i class="fas {{ $icon }}"></i>
        </div>
    @endif

    <h3 class="text-sm font-semibold text-gray-400">{{ $title }}</h3>
    <p class="mt-1 text-2xl font-bold text-white">{{ $value }}</p>
</div>
