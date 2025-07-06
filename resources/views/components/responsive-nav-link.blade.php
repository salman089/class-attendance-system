@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-gray-400 text-start text-base font-medium text-gray-400 bg-[#161615] hover:text-gray-800 hover:bg-gray-400 hover:border-gray-700 focus:outline-none focus:text-gray-800 focus:bg-gray-400 focus:border-gray-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-gray-800 hover:bg-gray-300 hover:border-gray-700 focus:outline-none focus:text-gray-800 focus:bg-gray-500 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
