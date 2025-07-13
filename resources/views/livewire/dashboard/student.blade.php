<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm bg-[#161615] sm:rounded-lg">
            <div class="p-6 space-y-6 text-white">

                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Student Dashboard</h3>
                </div>

                {{-- Cards --}}
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <x-dashboard.card title="Total Subjects" :value="$totalSubjects" icon="fa-book" color="indigo" />
                </div>

                {{-- Charts and Attendance --}}
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="p-4 bg-[#2e2b2b] hover:bg-[#555151] rounded-xl shadow">
                        <h2 class="mb-4 font-semibold text-white text-md">Weekly Attendance (Pie)</h2>
                        <canvas id="weeklyPieChart" height="220"></canvas>
                    </div>

                    <div class="p-6 bg-[#2e2b2b] hover:bg-[#555151] rounded-xl shadow">
                        <h2 class="mb-3 text-lg font-semibold text-white">Recent Attendance Records</h2>
                        <ul class="space-y-2 text-sm text-gray-300">
                            @forelse($recentAttendances as $entry)
                                <li>
                                    <strong class="text-white">{{ $entry->subject->name ?? '-' }}</strong> marked as
                                    <span class="font-semibold text-gray-400">{{ ucfirst($entry->status) }}</span>
                                    on {{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}
                                </li>
                            @empty
                                <li>No recent attendance records found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Chart Script --}}
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
                                        '#4ade80', // green
                                        '#f87171', // red
                                        '#60a5fa', // blue
                                        '#facc15', // yellow
                                        '#a78bfa', // purple
                                        '#f472b6', // pink
                                        '#38bdf8', // sky
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
