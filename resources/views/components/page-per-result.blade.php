<div class="mb-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
        <!-- Label -->
        <div>
            <label for="perPage" class="block text-sm font-medium text-gray-300">
                Records Per Page:
            </label>
        </div>

        <!-- Select -->
        <div>
            <select wire:model.live="perPage"
                    id="perPage"
                    class="mt-1 block w-full sm:w-auto rounded-md border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach ([5, 10, 25, 50, 100, 250] as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
