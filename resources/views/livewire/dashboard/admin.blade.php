<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm bg-[#161615] sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">Admin Dashboard</h3>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <x-dashboard.card title="Total Users" :value="$totalUsers" icon="fa-users" color="blue" />
                        <x-dashboard.card title="Teachers" :value="$totalTeachers" icon="fa-chalkboard-teacher"
                            color="green" />
                        <x-dashboard.card title="Students" :value="$totalStudents" icon="fa-user-graduate" color="indigo" />
                        <x-dashboard.card title="Classrooms" :value="$totalClassrooms" icon="fa-door-open" color="purple" />
                        <x-dashboard.card title="Subjects" :value="$totalSubjects" icon="fa-book" color="yellow" />
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="p-4 bg-[#2e2b2b] hover:bg-[#555151] rounded-xl shadow">
                            <h2 class="mb-4 font-semibold text-white text-md">Weekly Attendance (Pie)</h2>
                            <canvas id="weeklyPieChart" height="220"></canvas>
                        </div>

                        <div class="p-6 bg-[#2e2b2b] hover:bg-[#555151] rounded-xl shadow">
                            <h2 class="mb-3 text-lg font-semibold text-white">Recent Attendance Entries</h2>
                            <ul class="space-y-2 text-sm text-gray-300">
                                @forelse($recentAttendances as $entry)
                                    <li>
                                        <strong class="text-white">{{ $entry->student->name ?? '-' }}</strong>
                                        marked as
                                        <span class="font-semibold text-gray-400">{{ ucfirst($entry->status) }}</span>
                                        for <em>{{ $entry->subject->name ?? '-' }}</em> on
                                        {{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}
                                    </li>
                                @empty
                                    <li>No recent attendance records found.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    @push('scripts')
                        <script>
                            const weeklyLabels = Object.keys(@json($weeklyData));
                            const weeklyCounts = Object.values(@json($weeklyData));

                            new Chart(document.getElementById('weeklyPieChart'), {
                                type: 'pie',
                                data: {
                                    labels: weeklyLabels,
                                    datasets: [{
                                        data: weeklyCounts,
                                        backgroundColor: [
                                            '#4ade80',
                                            '#f87171',
                                            '#60a5fa',
                                            '#facc15'
                                        ],
                                        borderColor: '#0f172a',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                            labels: {
                                                color: '#e5e7eb',
                                                boxWidth: 12,
                                                padding: 20
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: '#1f2937',
                                            titleColor: '#f9fafb',
                                            bodyColor: '#f3f4f6'
                                        }
                                    },
                                    layout: {
                                        padding: 10
                                    }
                                }
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
