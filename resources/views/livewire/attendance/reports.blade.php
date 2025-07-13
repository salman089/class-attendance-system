<div>
    <form wire:submit.prevent>
        <!-- Header and Export Buttons -->
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-1">
                <h2 class="text-base font-semibold text-white">Attendance Reports</h2>
                <p class="text-sm text-gray-400">View and export filtered attendance records.</p>
            </div>
            @can('download_reports')
                @if ($attendances->count() > 0)
                    <div class="flex gap-3">
                        <button type="button" wire:click="exportExcel"
                            class="text-sm font-medium text-green-400 hover:underline">Export Excel</button>
                        <button type="button" wire:click="exportPDF"
                            class="text-sm font-medium text-red-500 hover:underline">Export PDF</button>
                    </div>
                @endif
            @endcan
        </div>

        <!-- Filters: All in One Line -->
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-end sm:gap-6">
            <!-- From Date -->
            <div class="w-full sm:w-1/4">
                <label class="block text-sm font-medium text-white">From Date</label>
                <input type="date" wire:model.live="fromDate"
                    class="mt-2 w-full h-[38px] px-3 py-2 text-white bg-[#1f1f1f] border border-[#363634] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
            </div>

            <!-- To Date -->
            <div class="w-full sm:w-1/4">
                <label class="block text-sm font-medium text-white">To Date</label>
                <input type="date" wire:model.live="toDate"
                    class="mt-2 w-full h-[38px] px-3 py-2 text-white bg-[#1f1f1f] border border-[#363634] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" />
            </div>

            <!-- Classroom -->
            <div class="w-full sm:w-1/4">
                <label class="block text-sm font-medium text-white">Classroom</label>
                <select wire:model.live="classroomId"
                    class="mt-2 w-full h-[38px] px-3 py-2 text-white bg-[#1f1f1f] border border-[#363634] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                    <option value="">All</option>
                    @foreach ($this->classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }} ({{ $classroom->section }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Subject -->
            <div class="w-full sm:w-1/4">
                <label class="block text-sm font-medium text-white">Subject</label>
                <select wire:model.live="subjectId"
                    class="mt-2 w-full h-[38px] px-3 py-2 text-white bg-[#1f1f1f] border border-[#363634] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm">
                    <option value="">All</option>
                    @foreach ($this->subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Attendance Report Table -->
        <div class="overflow-x-auto rounded-md shadow-md">
            <table class="w-full text-sm text-left text-gray-300 rtl:text-right">
                <thead class="text-xs text-white uppercase bg-black">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Roll No</th>
                        <th class="px-6 py-3">Student</th>
                        <th class="px-6 py-3">Subject</th>
                        <th class="px-6 py-3">Classroom</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Marked By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $index => $att)
                        <tr class="border-b border-[#363634] odd:bg-[#2c2c2c] even:bg-[#1f1f1f] hover:bg-gray-700">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $att->student->roll_no ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $att->student->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $att->subject->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $att->classroom->name ?? '-' }}
                                ({{ $att->classroom->section ?? '-' }})
                            </td>
                            <td class="px-6 py-4">{{ $att->date }}</td>
                            <td class="px-6 py-4">{{ ucfirst($att->status) }}</td>
                            <td class="px-6 py-4">{{ $att->marker->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr class="bg-[#2c2c2c] text-gray-400">
                            <td colspan="8" class="px-6 py-4 text-center">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>
</div>
