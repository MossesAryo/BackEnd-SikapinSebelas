@extends('layouts.app')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .gradient-bg {
        background: linear-gradient(135deg, #0083ee 0%, #005bb5 100%);
    }


    .main-content-expanded {
        margin-left: 20px;
    }

    .chart-container {
        position: relative;
        height: 350px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeInUp 0.5s ease-out;
    }
</style>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        500: '#0083ee',
                        600: '#005bb5',
                        700: '#1d4ed8'
                    }
                }
            }
        }
    }
</script>
@section('content')
    <!-- Main Content -->
    <div id="mainContent" class="transition-all duration-300">

        <!-- Dashboard Content -->
        <main class="p-4">
            <!-- Welcome Card -->
            <div class="gradient-bg rounded-2xl text-white p-8 mb-6 fade-in">
                <div class="max-w-2xl">
                    <h4 class="text-xl font-semibold mb-3">Pantau sistem skoring siswa Anda hari ini!</h4>
                    <p class="opacity-75 mb-6">Kelola poin apresiasi dan pelanggaran untuk meningkatkan prestasi siswa</p>
                    <button
                        class="bg-white text-[#0083ee] px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                        Lihat Detail Skor
                    </button>

                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div
                    class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 fade-in">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Total Siswa</p>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">2,345</h2>
                            <div class="flex items-center gap-1">
                                <i class="bi bi-arrow-up text-green-500 text-sm"></i>
                                <span class="text-green-500 text-sm font-medium">+12%</span>
                                <span class="text-gray-500 text-sm">vs bulan lalu</span>
                            </div>
                        </div>
                        <div
                            class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center transition-transform hover:scale-110">
                            <i class="bi bi-people text-2xl text-primary-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 fade-in"
                    style="animation-delay: 0.1s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Total Apresiasi</p>
                            <h2 class="text-3xl font-bold text-green-600 mb-2">1,234</h2>
                            <div class="flex items-center gap-1">
                                <i class="bi bi-arrow-up text-green-500 text-sm"></i>
                                <span class="text-green-500 text-sm font-medium">+8%</span>
                                <span class="text-gray-500 text-sm">vs bulan lalu</span>
                            </div>
                        </div>
                        <div
                            class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center transition-transform hover:scale-110">
                            <i class="bi bi-award text-2xl text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 fade-in"
                    style="animation-delay: 0.2s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Total Pelanggaran</p>
                            <h2 class="text-3xl font-bold text-red-600 mb-2">567</h2>
                            <div class="flex items-center gap-1">
                                <i class="bi bi-arrow-down text-green-500 text-sm"></i>
                                <span class="text-green-500 text-sm font-medium">-15%</span>
                                <span class="text-gray-500 text-sm">vs bulan lalu</span>
                            </div>
                        </div>
                        <div
                            class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center transition-transform hover:scale-110">
                            <i class="bi bi-exclamation-triangle text-2xl text-red-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 fade-in"
                    style="animation-delay: 0.3s">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Rata-rata Skor</p>
                            <h2 class="text-3xl font-bold text-primary-500 mb-2">85.2</h2>
                            <div class="flex items-center gap-1">
                                <i class="bi bi-arrow-up text-green-500 text-sm"></i>
                                <span class="text-green-500 text-sm font-medium">+3.2%</span>
                                <span class="text-gray-500 text-sm">vs bulan lalu</span>
                            </div>
                        </div>
                        <div
                            class="w-14 h-14 bg-primary-50 rounded-xl flex items-center justify-center transition-transform hover:scale-110">
                            <i class="bi bi-bar-chart text-2xl text-primary-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
                <!-- Apresiasi per Jurusan Chart -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 fade-in">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-900">Apresiasi per Jurusan</h5>
                            <p class="text-gray-500 text-sm">Data apresiasi seluruh jurusan</p>
                        </div>
                        <div class="bg-[#0083ee] rounded-full p-1 flex">
                            <button
                                class="btn-toggle px-4 py-2 rounded-full text-sm font-medium text-[#0083ee] bg-white shadow-sm transition-all">
                                Minggu
                            </button>
                            <button
                                class="btn-toggle px-4 py-2 rounded-full text-sm font-medium text-white hover:bg-[#006dcc] transition-all">
                                Bulan
                            </button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="comparisonChart"></canvas>
                    </div>
                </div>

                <!-- Pelanggaran per Jurusan Chart -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 fade-in">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-900">Pelanggaran Per Jurusan</h5>
                            <p class="text-gray-500 text-sm">Data pelanggaran seluruh jurusan</p>
                        </div>
                        <div class="bg-[#0083ee] rounded-full p-1 flex">
                            <button
                                class="btn-toggle px-4 py-2 rounded-full text-sm font-medium text-[#0083ee] bg-white shadow-sm transition-all">
                                Minggu
                            </button>
                            <button
                                class="btn-toggle px-4 py-2 rounded-full text-sm font-medium text-white hover:bg-[#006dcc] transition-all">
                                Bulan
                            </button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-gray-200 fade-in">
                <div class="border-b border-gray-200 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-900 mb-1">Aktivitas Terbaru</h5>
                            <p class="text-gray-500 text-sm">Update terkini dari sistem</p>
                        </div>
                        <button
                            class="border border-primary-500 text-primary-500 px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 transition-colors">
                            Lihat Semua
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="activity-item flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-award text-green-600"></i>
                        </div>
                        <div class="flex-grow">
                            <p class="font-medium text-gray-900 mb-1">Ahmad Rizki mendapat apresiasi</p>
                            <p class="text-gray-500 text-sm mb-1">"Juara 1 Lomba Programming Tingkat Nasional"</p>
                            <p class="text-gray-400 text-xs">2 menit yang lalu</p>
                        </div>
                        <div class="text-green-600 text-sm font-medium">+40 poin</div>
                    </div>

                    <div class="activity-item flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="flex-grow">
                            <p class="font-medium text-gray-900 mb-1">Siti Nurhaliza mendapat pelanggaran</p>
                            <p class="text-gray-500 text-sm mb-1">"Terlambat masuk kelas lebih dari 15 menit"</p>
                            <p class="text-gray-400 text-xs">5 menit yang lalu</p>
                        </div>
                        <div class="text-red-600 text-sm font-medium">-10 poin</div>
                    </div>

                    <div class="activity-item flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-yellow-50 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-star text-yellow-600"></i>
                        </div>
                        <div class="flex-grow">
                            <p class="font-medium text-gray-900 mb-1">Budi Santoso mendapat apresiasi</p>
                            <p class="text-gray-500 text-sm mb-1">"Siswa Teladan Bulan Maret 2024"</p>
                            <p class="text-gray-400 text-xs">10 menit yang lalu</p>
                        </div>
                        <div class="text-yellow-600 text-sm font-medium">+75 poin</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('main-content-expanded');

            // Hide/show sidebar text
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            sidebarTexts.forEach(text => {
                if (sidebar.classList.contains('sidebar-collapsed')) {
                    text.classList.add('opacity-0', 'pointer-events-none');
                } else {
                    text.classList.remove('opacity-0', 'pointer-events-none');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');

            function createGradient(ctx, color1, color2) {
                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, color1);
                gradient.addColorStop(1, color2);
                return gradient;
            }

            const appreciationGradient = createGradient(comparisonCtx, '#10B981', '#059669');
            const violationGradient = createGradient(comparisonCtx, '#EF4444', '#DC2626');

            new Chart(comparisonCtx, {
                type: 'bar',
                data: {
                    labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'DKV', 'RPL', 'TKJ'],
                    datasets: [{
                        label: 'Apresiasi',
                        data: [450, 385, 420, 275, 310, 395, 340],
                        backgroundColor: appreciationGradient,
                        borderRadius: 6,
                        borderSkipped: false,
                        barThickness: 25,
                        maxBarThickness: 30,
                    }, ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                title: function(context) {
                                    return `Jurusan ${context[0].label}`;
                                },
                                label: function(context) {
                                    const label = context.dataset.label;
                                    const value = context.parsed.y;
                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)',
                                lineWidth: 1
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#374151',
                                font: {
                                    size: 13,
                                    weight: '600'
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1200,
                        easing: 'easeOutCubic'
                    }
                }
            });

            const categoryCtx = document.getElementById('categoryChart').getContext('2d');

            const violationCatGradient = createGradient(categoryCtx, '#EF4444', '#DC2626');

            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'DKV', 'RPL', 'TKJ'],
                    datasets: [{
                        label: 'Pelanggaran',
                        data: [45, 32, 78, 23, 56, 41, 38],
                        backgroundColor: violationCatGradient,
                        borderRadius: 6,
                        borderSkipped: false,
                        barThickness: 25,
                        maxBarThickness: 30,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                title: function(context) {
                                    return `Jurusan ${context[0].label}`;
                                },
                                label: function(context) {
                                    const label = context.dataset.label;
                                    const value = context.parsed.y;
                                    return `${label}: ${value} kasus`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)',
                                lineWidth: 1
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#374151',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1200,
                        easing: 'easeOutCubic'
                    }
                }
            });
        });

        // Toggle buttons functionality
        document.querySelectorAll('.btn-toggle').forEach(btn => {
            btn.addEventListener('click', function() {
                const parent = this.parentElement;
                parent.querySelectorAll('.btn-toggle').forEach(b => {
                    b.classList.remove('text-primary-500', 'bg-white', 'shadow-sm');
                    b.classList.add('text-gray-600', 'hover:text-gray-900');
                });
                this.classList.add('text-primary-500', 'bg-white', 'shadow-sm');
                this.classList.remove('text-gray-600', 'hover:text-gray-900');
            });
        });

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
@endsection
