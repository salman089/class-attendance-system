<div>
    <form wire:submit="save">
        <!-- Section Header -->
        <div class="pb-4 mb-6">
            <div class="pb-6 border-b border-gray-700">
                <h2 class="text-base font-semibold text-white">Role Information</h2>
                <p class="mt-1 text-sm text-gray-400">
                    {{ $role->exists ? 'Update the role\'s details.' : 'Fill in the role\'s details.' }}
                </p>
            </div>

            <!-- Form Fields -->
            <div class="gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                <div class="mt-6 space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-white">Name</label>
                        <input type="text" wire:model="name" id="name" placeholder="Enter full name"
                            class="mt-2 w-1/2 rounded-md bg-[#1f1f1f] h-[38px] px-3 py-2 text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
                        @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Permissions Table -->
                    <div>
                        <label for="permissions" class="block text-sm font-medium text-white">Permissions</label>

                        <table class="w-full mt-2 text-sm text-left text-gray-300 rtl:text-right">
                            <thead class="text-xs text-white bg-[#2f2f2f]">
                                <tr>
                                    <th class="w-1/4 px-4 py-3">Category</th>
                                    <th class="px-4 py-3">Permission</th>
                                    <th class="px-4 py-3">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissionCategories as $category)
                                    @foreach ($category->permissions as $permission)
                                        <tr class="border-b border-[#2f2f2f] group odd:bg-[#292929] even:bg-[#1f1f1f]">
                                            @if ($loop->first)
                                                <td class="px-4 py-3" rowspan="{{ $category->permissions->count() }}">
                                                    {{ $category->name }}
                                                </td>
                                            @endif
                                            <td
                                                class="px-4 py-3 transition-colors duration-150 group-hover:bg-gray-700">
                                                <label class="inline-flex items-center space-x-2">
                                                    <input type="checkbox" wire:model="selectedPermissions"
                                                        value="{{ $permission->id }}"
                                                        class="text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500" />
                                                    <span>{{ $permission->title }}</span>
                                                </label>
                                            </td>
                                            <td
                                                class="px-4 py-3 transition-colors duration-150 group-hover:bg-gray-700">
                                                {{ $permission->description }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                        @error('selectedPermissions')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end mt-8 gap-x-4">
                <a href="{{ route('user.role.index') }}"
                    class="px-2 text-sm font-semibold leading-6 text-gray-300 hover:text-white">Back</a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
