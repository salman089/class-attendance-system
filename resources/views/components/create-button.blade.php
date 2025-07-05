@props(['href' => null])

@if ($href)
    <a href="{{ $href }}"
       {{ $attributes->merge([
           'class' => 'inline-flex items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white bg-blue-600 rounded-md
                       hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'
       ]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white bg-blue-600 rounded-md
                    hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'
    ]) }}>
        {{ $slot }}
    </button>
@endif
