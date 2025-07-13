<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm bg-[#161615] sm:rounded-lg">
                <div class="p-6 text-white">

                    <div class="flex flex-col gap-4 mb-4 sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-white">
                            Attendance Details: {{ $subject->name }} ({{ $formattedDate }})
                        </h3>
                    </div>

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
                                @forelse ($students as $student)
                                    @php
                                        $status = $statuses[$student->id] ?? 'Not Marked';
                                    @endphp
                                    <tr
                                        class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                                        <td class="px-6 py-4">{{ $student->id }}</td>
                                        <td class="px-6 py-4">{{ $student->name }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm
                                                    {{ $status === 'present'
                                                        ? 'text-green-400'
                                                        : ($status === 'absent'
                                                            ? 'text-red-400'
                                                            : ($status === 'late'
                                                                ? 'text-yellow-400'
                                                                : ($status === 'leave'
                                                                    ? 'text-blue-400'
                                                                    : 'text-gray-400'))) }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-b border-[#363634] bg-[#2c2c2c] text-gray-400">
                                        <td colspan="3" class="px-6 py-4 text-center">
                                            No students found in this class.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('attendance.index', ['date' => $date ]) }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="mr-2 fa-solid fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
