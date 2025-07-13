<div>
    <div class="flex flex-col gap-4 mt-2 mb-2 sm:flex-row sm:items-center sm:justify-between">
        {{-- Title --}}
        <div class="flex items-center space-x-2">
            <h3 class="text-lg font-semibold text-white">Manage Attendance</h3>
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-3 sm:justify-end">

            {{-- Pagination & Search if needed --}}
            @include('partials.search', [
                'label' => 'Search by subject, teacher, or classroom...',
            ])
            @include('partials.pagination')

            {{-- Create Button --}}
            <a href="{{ route('attendance.index') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-clipboard"></i>
                    <span>Report</span>
                </div>
            </a>
        </div>
    </div>

    {{-- Date Picker --}}
    <div class="flex justify-end mt-3">
        <div class="flex items-center space-x-2">
            <label for="date" class="text-sm font-semibold text-white">Date:</label>
            <input type="date" wire:model.live="date" id="date" onclick="this.showPicker()"
                class="text-sm text-white bg-black rounded-md shadow-sm border-b border-[#363634] focus:border-blue-500 focus:ring-blue-500 px-2 py-2"
                style="color-scheme: dark;" />
            @error('date')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
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
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Subject</th>
                                <th class="px-6 py-3">Classroom</th>
                                <th class="px-6 py-3">Marked?</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                @php
                                    $isMarked = \App\Models\Attendance::where('subject_id', $subject->id)
                                        ->where('date', $date)
                                        ->exists();
                                @endphp
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
                                        @if ($isMarked)
                                            <span class="text-green-400">Yes</span>
                                        @else
                                            <span class="text-red-400">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                        <a href="{{ route('attendance.mark', [$subject->id, $date]) }}"
                                            class="font-medium {{ $isMarked ? 'text-green-400' : 'text-violet-400' }} hover:underline">
                                            {{ $isMarked ? 'Edit' : 'Mark' }}
                                        </a>

                                        <a href="{{ route('attendance.show', [$subject->id, $date]) }}"
                                            class="font-medium text-blue-400 hover:underline">
                                            View
                                        </a>

                                        <!-- Excel Export (Controller Route) -->
                                        <button type="button" wire:click="exportExcel({{ $subject->id }}, '{{ $date }}')"
                                            class="font-medium text-green-300 hover:underline">
                                            Export Excel
                                        </button>

                                        <!-- PDF Export (Controller Route) -->
                                        <button type="button" wire:click="exportPDF({{ $subject->id }}, '{{ $date }}')"
                                            class="font-medium text-red-600 hover:underline">
                                            Export PDF
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-[#363634] bg-[#2c2c2c] text-gray-400">
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        No subjects found for attendance.
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
