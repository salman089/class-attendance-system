@props([
    'style' => 'primary',
    'type' => 'submit',
    'small' => true,
    'class' => null,
    'confirmationMessage' => null,
])

<button type="{{ $type }}" @if ($confirmationMessage) wire:confirm="{{ $confirmationMessage }}" @endif
    wire:loading.attr="disabled"
    class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-900 focus:text-white active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $class }}"
    {{ $attributes }}>
    <i class="mr-1 fa-solid fa-check-circle"></i>
    Save
</button>
