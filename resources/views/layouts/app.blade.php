@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
    
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #0083ee, #0a50c1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card-hover:hover {
            transform: translateY(-4px);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #0083ee;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover::before {
            transform: scaleX(1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Dashboard Layout -->
    <div class="flex">
        <!-- Sidebar Placeholder -->
        <div class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white font-bold">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Sikapin</h1>
                        <p class="text-xs text-gray-500">Sistem Skoring</p>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.navbar')

            <!-- Dashboard Content -->
        @yield('main')    
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Charts
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'RPL', 'DKV', 'TJKT'],
                    datasets: [{
                        label: 'Apresiasi',
                        data: [120, 190, 300, 500, 200, 300, 400],
                        backgroundColor: 'rgba(34, 197, 94, 0.7)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            const expenseCtx = document.getElementById('expenseChart').getContext('2d');
            const expenseChart = new Chart(expenseCtx, {
                type: 'bar',
                data: {
                    labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'RPL', 'DKV', 'TJKT'],
                    datasets: [{
                        label: 'Pelanggaran',
                        data: [100, 150, 250, 300, 180, 200, 350],
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Toggle button functionality
            document.querySelectorAll('.toggle-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Get the parent toggle container
                    const toggleContainer = this.parentElement;
                    const buttons = toggleContainer.querySelectorAll('.toggle-btn');
                    
                    // Remove active state from all buttons in this container
                    buttons.forEach(button => {
                        button.classList.remove('bg-white', 'text-blue-500');
                        button.classList.add('text-white');
                    });
                    
                    // Add active state to clicked button
                    this.classList.add('bg-white', 'text-blue-500');
                    this.classList.remove('text-white');
                });
            });
        });
    </script>
</body>

