<div>
    <form wire:submit="save">
        <!-- Section Header -->
        <div class="space-y-12">
            <div class="pb-6 border-b border-gray-700">
                <h2 class="text-base font-semibold leading-7 text-white">Subject Information</h2>
                <p class="mt-1 text-sm text-gray-400">
                    {{ $subject->exists ? 'Update the subject\'s details.' : 'Fill in the subject\'s details.' }}
                </p>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-3 sm:grid-cols-6">
            <!-- Name -->
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium text-white">Name</label>
                <div class="mt-2">
                    <input type="text" wire:model="name" id="name" placeholder="Enter subject name"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="subject_code" class="block text-sm font-medium text-white">Subject Code</label>
                <div class="mt-2">
                    <input type="text" wire:model="subject_code" id="subject_code" placeholder="Enter subject code"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                    @error('subject_code')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Classroom Dropdown -->
            <div class="sm:col-span-3">
                <label for="classroom_id" class="block text-sm font-medium text-white">Classroom</label>
                <div class="mt-2">
                    <select wire:model="classroom_id" id="classroom_id"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                        <option value=""> No Classroom Selected </option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->section }})
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Teacher Dropdown -->
            <div class="sm:col-span-3">
                <label for="teacher_id" class="block text-sm font-medium text-white">Teacher</label>
                <div class="mt-2">
                    <select wire:model="teacher_id" id="teacher_id"
                        class="block w-full rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                        <option value="">No Teacher Selected</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->name }} ({{ $teacher->roles->pluck('name')->join(', ') }})
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="col-span-full">
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <div class="mt-2">
                    <textarea wire:model="description" id="description" rows="4" placeholder="Enter subject description"
                        class="block w-full rounded-md bg-[#1f1f1f] px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm"></textarea>
                    @error('description')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>



        <!-- Form Actions -->
        <div class="flex items-center justify-end mt-8 gap-x-4">
            <a href="{{ route('subject.index') }}"
                class="px-2 text-sm font-semibold leading-6 text-gray-300 hover:text-white">Back</a>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save
            </button>
        </div>
    </form>
</div>
