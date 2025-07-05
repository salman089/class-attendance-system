<div>
    <div class="flex flex-col gap-4 mb-2 sm:flex-row sm:items-center sm:justify-between">
        <!-- Title -->
        <div class="flex items-center space-x-2">
            <i class="text-white fa-solid fa-graduation-cap"></i>
            <h3 class="text-lg font-semibold text-white">Manage Classrooms</h3>
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap items-center gap-3 sm:justify-end">

            <!-- Filter -->
            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-sm font-semibold text-white">Filter:</label>
                <select wire:model.live="perPage" id="perPage"
                    class="text-sm text-white bg-black rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <!-- Create Button -->
            <x-create-button href="{{ route('classroom.create') }}">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Create</span>
                </div>
            </x-create-button>
        </div>
    </div>


    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-black ">
                            <tr>
                                @foreach ($columns as $column)
                                    <th scope="col" class="px-6 py-3">
                                        {{ $column }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($classrooms as $classroom)
                                <tr
                                    class="border-b border-[#363634] odd:bg-[#363634] odd:text-gray-400 even:bg-[#52524f] even:text-gray-200">
                                    <td class="px-6 py-4">
                                        {{ $classroom->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $classroom->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $classroom->section }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('classroom.edit', $classroom->id) }}"
                                            class="px-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Edit
                                        </a>
                                        <button wire:click.live="delete({{ $classroom->id }})"
                                            onclick="return confirm('Are you sure you want to delete?') || event.stopImmediatePropagation()"
                                            class="px-2 font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $classrooms->links() }}
    </div>
</div>
