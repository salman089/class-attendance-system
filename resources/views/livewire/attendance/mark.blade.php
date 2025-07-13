<div>
    <!-- Header -->
    <div class="flex flex-col gap-4 mb-4 sm:flex-row sm:items-center sm:justify-between">
        <h3 class="text-lg font-semibold text-white">
            Mark Attendance: {{ $subject->name ?? 'N/A' }} ({{ $this->formattedDate }})
        </h3>
    </div>

    @if (count($students) > 0)
        <form wire:submit.prevent="save">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-300 rtl:text-right">
                    <thead class="text-xs text-white uppercase bg-black">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $student->roll_no }}</td>
                                <td class="px-6 py-4">{{ $student->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-4">
                                        @foreach (['present' => 'Present', 'absent' => 'Absent', 'late' => 'Late', 'leave' => 'Leave'] as $value => $label)
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="statuses[{{ $student->id }}]"
                                                    wire:model="statuses.{{ $student->id }}"
                                                    value="{{ $value }}"
                                                    class="text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" />
                                                <span class="ml-1 text-white">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('statuses.' . $student->id)
                                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end mt-8 gap-x-4">
                <a href="{{ route('attendance.index', ['date' => $date]) }}"
                    class="px-2 text-sm font-semibold leading-6 text-gray-300 hover:text-white">Back</a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save
                </button>
            </div>
        </form>
    @else
        <p class="text-gray-300">No students found for this subject's classroom.</p>
    @endif
</div>
