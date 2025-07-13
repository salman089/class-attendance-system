<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm bg-[#161615] sm:rounded-lg">
                <div class="p-6 text-white">
                    @livewire('attendance.reports', [
                        'fromDate' => $fromDate,
                        'toDate' => $toDate,
                        'classroomId' => $classroomId,
                        'subjectId' => $subjectId,
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
