<div>
    <div class="flex flex-col gap-4 mt-2 mb-2 sm:flex-row sm:items-center sm:justify-between">
        {{-- Title --}}
        <div class="flex items-center space-x-2">
            <h3 class="text-lg font-semibold text-white">Manage Roles</h3>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-3 sm:justify-end">

            {{-- Search --}}
            @include('partials.search', [
                'label' => 'Search by role name...',
            ])

            {{-- Filter  --}}
            @include('partials.pagination')

            {{-- Create Button --}}
            <x-create-button href="{{ route('user.role.create') }}">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Create</span>
                </div>
            </x-create-button>

            <a href="{{ route('user.index') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <i class="mr-2 fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    @include('partials.success')
                    @include('partials.alert')

                    <table class="w-full text-sm text-left text-gray-300 rtl:text-right">
                        <thead class="text-xs text-white uppercase bg-black">
                            <tr>
                                @foreach ($columns as $column)
                                    <th scope="col" class="px-6 py-3">
                                        {{ $column }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr
                                    class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $role->id }}</td>
                                    <td class="px-6 py-4">{{ $role->name }}</td>
                                    <td class="px-6 py-4">{{ $role->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="px-6 py-4">{{ $role->updated_at->format('M d, Y h:i A') }}</td>
                                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">

                                        {{-- Edit --}}
                                        <a href="{{ route('user.role.edit', $role->id) }}"
                                            class="font-medium text-green-400 hover:underline">
                                            Edit
                                        </a>

                                        {{-- Show --}}
                                        <a href="{{ route('user.role.show', $role->id) }}"
                                            class="font-medium text-blue-400 hover:underline">
                                            Show
                                        </a>

                                        {{-- Delete --}}
                                        <button wire:click="delete({{ $role->id }})" wire:loading.attr="disabled"
                                            onclick="return confirm('Are you sure you want to delete this user?') || event.stopImmediatePropagation()"
                                            class="font-medium text-red-400 hover:underline">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-[#363634] bg-[#2c2c2c] text-gray-400">
                                    <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center">
                                        No roles found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $roles->links() }}
    </div>
</div>
