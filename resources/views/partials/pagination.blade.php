<div class="flex items-center space-x-2">
    <label for="perPage" class="text-sm font-semibold text-white">Records Per Page:</label>
    <select wire:model.live="perPage" id="perPage"
        class="text-sm text-white bg-black rounded-md shadow-sm border-b border-[#363634] focus:border-blue-500 focus:ring-blue-500">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>
