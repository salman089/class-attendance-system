<div class="p-4 bg-[#1f1f1f] rounded-lg shadow">
    <h2 class="mb-2 text-sm font-semibold text-gray-400">{{ $title }}</h2>
    <canvas id="{{ $chartId }}" height="200"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_keys($data)) !!},
                    datasets: [{
                        label: 'Attendance',
                        data: {!! json_encode(array_values($data)) !!},
                        backgroundColor: [
                            '#60A5FA', '#34D399', '#FBBF24', '#EF4444', '#A78BFA'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</div>
