<div>
    <div class="flex flex-col gap-4 mt-2 mb-2 sm:flex-row sm:items-center sm:justify-between">
        {{-- Title --}}
        <div class="flex items-center space-x-2">
            <h3 class="text-lg font-semibold text-white">Manage Subjects</h3>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-3 sm:justify-end">

            {{-- Search --}}
            @include('partials.search', [
                'label' => 'Search by subject, teacher name, classroom name or section...',
            ])

            {{-- Filter  --}}
            @include('partials.pagination')

            {{-- Create Button --}}
            @can('create_subjects')
                <x-create-button href="{{ route('subject.create') }}">
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
                            @forelse ($subjects as $subject)
                                <tr
                                    class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $subject->id }}</td>
                                    <td class="px-6 py-4">{{ $subject->name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($subject->classroom)
                                            {{ $subject->classroom->name }} ({{ $subject->classroom->section }})
                                        @else
                                            Not assigned
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($subject->teacher)
                                            {{ $subject->teacher->name }}
                                        @else
                                            Not assigned
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">

                                        {{-- Edit --}}
                                        @can('edit_subjects')
                                            <a href="{{ route('subject.edit', $subject->id) }}"
                                                class="font-medium text-green-400 hover:underline">
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Show --}}
                                        @can('view_subjects')
                                            <a href="{{ route('subject.show', $subject->id) }}"
                                                class="font-medium text-blue-400 hover:underline">
                                                Show
                                            </a>
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete_subjects')
                                            <button type="button" wire:click="delete({{ $subject->id }})"
                                                class="font-medium text-red-400 hover:underline">
                                                Delete
                                            </button>
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
        {{ $subjects->links() }}
    </div>
</div>
