<div>
    <div class="flex flex-col gap-4 mt-2 mb-2 sm:flex-row sm:items-center sm:justify-between">
        {{-- Title --}}
        <div class="flex items-center space-x-2">
            <h3 class="text-lg font-semibold text-white">Manage Classrooms</h3>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-3 sm:justify-end">

            {{-- Search --}}
            @include('partials.search', [
                'label' => 'Search by name or section...',
            ])

            {{-- Filter  --}}
            @include('partials.pagination')

            {{-- Create Button --}}
            @can('create_classrooms')
                <x-create-button href="{{ route('classroom.create') }}">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-plus"></i>
                        <span>Create</span>
                    </div>
                </x-create-button>
            @endcan
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
                            @forelse ($classrooms as $classroom)
                                <tr
                                    class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $classroom->id }}</td>
                                    <td class="px-6 py-4">{{ $classroom->name }}</td>
                                    <td class="px-6 py-4">{{ $classroom->section }}</td>
                                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">

                                        {{-- Edit --}}
                                        @can('edit_classrooms')
                                            <a href="{{ route('classroom.edit', $classroom->id) }}"
                                                class="font-medium text-green-400 hover:underline">
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Show --}}
                                        @can('view_classrooms')
                                            <a href="{{ route('classroom.show', $classroom->id) }}"
                                                class="font-medium text-blue-400 hover:underline">
                                                Show
                                            </a>
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete_classrooms')
                                            <form action="{{ route('classroom.destroy', $classroom->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this classroom?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-400 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-[#363634] bg-[#2c2c2c] text-gray-400">
                                    <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center">
                                        No classrooms found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{ $classrooms->links() }}
    </div>
</div>
