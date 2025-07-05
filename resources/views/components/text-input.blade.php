@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-black text-white block mt-1 w-full border-gray-700 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) }}>
