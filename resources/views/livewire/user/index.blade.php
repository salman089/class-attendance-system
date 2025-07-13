<div>
    <div class="flex items-center justify-between gap-10 py-2">
        <!-- Title -->
        <h3 class="text-lg font-semibold text-white whitespace-nowrap">Manage Users</h3>

        <!-- Actions -->
        <div class="flex items-center gap-3">
            {{-- Search --}}
            @include('partials.search', ['label' => 'Search by name or email...'])


            {{-- Pagination --}}
            @include('partials.pagination')

            {{-- Create Button --}}
            @can('create_users')
                @if ($roles->isNotEmpty())
                    <x-create-button href="{{ route('user.create') }}">
                        <i class="mr-1 fa-solid fa-user-plus"></i>
                        <span>Create</span>
                    </x-create-button>
                @endif
            @endcan

            {{-- Roles --}}
            @if (auth()->user()->is_superuser)
                <a href="{{ route('user.role.index') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <i class="mr-2 fa-solid fa-user-secret"></i>
                    Roles
                </a>
            @endif
        </div>
    </div>

    {{-- Filter --}}
    <div class="flex justify-end mt-2">
        @include('partials.filter')
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
                            @forelse ($users as $user)
                                <tr
                                    class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->phone }}</td>
                                    @forelse ($user->roles as $role)
                                        <td class="px-6 py-4">{{ $role->name }}</td>
                                    @empty
                                        <td class="px-6 py-4">No roles assigned</td>
                                    @endforelse
                                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">

                                        {{-- Edit --}}
                                        @can('edit_users')
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="font-medium text-green-400 hover:underline">
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Show --}}
                                        @can('view_users')
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="font-medium text-blue-400 hover:underline">
                                                Show
                                            </a>
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete_users')
                                            @if (!$user->is_superuser && $user->id !== auth()->id())
                                                <button wire:click="delete({{ $user->id }})"
                                                    wire:loading.attr="disabled"
                                                    onclick="if (!confirm('Are you sure you want to delete this user?')) event.stopImmediatePropagation();"
                                                    class="font-medium text-red-400 hover:underline">
                                                    Delete
                                                </button>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-[#363634] bg-[#2c2c2c] text-gray-400">
                                    <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $users->links() }}
    </div>
</div>
