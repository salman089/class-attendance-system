<div>
    <div class="flex flex-col gap-4 mt-2 mb-2 sm:flex-row sm:items-center sm:justify-between">
        {{-- Title --}}
        <div class="flex items-center space-x-2">
            <i class="text-white fa-solid fa-users"></i>
            <h3 class="text-lg font-semibold text-white">Manage Users</h3>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-3 sm:justify-end">

            {{-- Search --}}
            @include('partials.search', [
                'label' => 'Search by user name or email...',
            ])

            {{-- Filter  --}}
            @include('partials.pagination')

            {{-- Create Button --}}
            @can('create_users')
                @if ($roles->isNotEmpty())
                    <x-create-button href="{{ route('user.create') }}">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Create</span>
                        </div>
                    </x-create-button>
                @endif
            @endcan

            {{-- Roles --}}
            @if (auth()->user()->is_superuser)
                <a href="{{ route('user.role.index') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 rounded-md hover:bg-green-500 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <i class="mr-2 fa-solid fa-user-secret"></i>
                    Roles
                </a>
            @endif
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
                            @forelse ($users as $user)
                                <tr
                                    class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->phone }}</td>
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
