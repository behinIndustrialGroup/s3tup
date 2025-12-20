@php
    $chartId = 'province-chart-' . uniqid();
    $labels = array_keys($provinceCounts ?? []);
    $data = array_values($provinceCounts ?? []);
@endphp

<div class="w-full">
    <div class="bg-white rounded-2xl shadow px-6 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h2 class="text-xl font-bold text-gray-900">تعداد ثبت‌نام صنایع به تفکیک استان</h2>
            </div>
            {{-- <div class="text-xs text-gray-500 bg-sky-50 text-sky-800 px-3 py-1 rounded-full border border-sky-100">به‌روزرسانی خودکار با ثبت‌های جدید</div> --}}
        </div>
        <div class="mt-6" style="min-height: 320px;">
            <canvas id="{{ $chartId }}" class="w-full h-full"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (() => {
        const ctx = document.getElementById('{{ $chartId }}');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels, JSON_UNESCAPED_UNICODE) !!},
                datasets: [{
                    label: 'تعداد ثبت‌نام صنایع به تفکیک استان',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(14, 165, 233, 0.25)',
                    borderColor: 'rgb(14, 165, 233)',
                    borderWidth: 1.5,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(14, 165, 233, 0.35)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => `${context.parsed.y ?? 0} ثبت‌نام`
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#1f2937',
                            font: {
                                family: 'Vazirmatn, sans-serif',
                                size: 12,
                            }
                        },
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#1f2937',
                            font: {
                                family: 'Vazirmatn, sans-serif',
                                size: 12,
                            }
                        },
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)'
                        }
                    }
                }
            }
        });
    })();
</script>
