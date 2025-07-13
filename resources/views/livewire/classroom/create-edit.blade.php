<div>
    <form wire:submit="save">
        <!-- Section Header -->
        <div class="space-y-12">
            <div class="pb-6 border-b border-gray-700">
                <h2 class="text-base font-semibold leading-7 text-white">Classroom Information</h2>
                <p class="mt-1 text-sm text-gray-400">
                    {{ $classroom->exists ? 'Update the classroom\'s details.' : 'Fill in the classroom\'s details.' }}
                </p>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-8 sm:grid-cols-6">
            <!-- Name -->
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium leading-6 text-white">Name</label>
                <div class="mt-2">
                    <input type="text" wire:model="name" id="name" placeholder="Enter classroom name"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Section -->
            <div class="sm:col-span-3">
                <label for="section" class="block text-sm font-medium leading-6 text-white">Section</label>
                <div class="mt-2">
                    <input type="text" wire:model="section" id="section" placeholder="e.g. A, B, C"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                    @error('section')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Teacher Dropdown -->
            <div class="sm:col-span-3">
                <label for="head_of_department" class="block text-sm font-medium text-white">Head of Department</label>
                <div class="mt-2">
                    <select wire:model="head_of_department_id" id="head_of_department"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                        <option value="">No Head of Department Selected</option>
                        @foreach ($head_of_departments as $head_of_department)
                            <option value="{{ $head_of_department->id }}">
                                {{ $head_of_department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('head_of_department_id')
                        <span class="text-sm text-red-500">Please select a head of department</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end mt-8 gap-x-4">
            <a href="{{ route('classroom.index') }}"
                class="px-2 text-sm font-semibold leading-6 text-gray-300 hover:text-white">Back</a>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save
            </button>
        </div>
    </form>
</div>
