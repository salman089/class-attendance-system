<div class="flex items-center space-x-2">
    <label for="search" class="text-sm font-semibold text-white">Search:</label>
    <input type="text" wire:model.live="search" id="search" placeholder="{{ $label ?? 'Search...' }}"
        class="text-sm text-white bg-black rounded-md shadow-sm w-80 border-b border-[#363634] focus:border-blue-500 focus:ring-blue-500">
</div>
