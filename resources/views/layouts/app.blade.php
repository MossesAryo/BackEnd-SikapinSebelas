<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikapin - Sistem Skoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #0083ee, #0a50c1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-card-hover:hover {
            transform: translateY(-4px);
        }

        .stat-card {
            position: relative;
            transition: transform 0.3s ease;
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
    @stack('css')
</head>

<body class="bg-gray-50">
    <!-- Dashboard Layout -->
    <div class="flex">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Navigation -->
            @include('layouts.navbar')

            <!-- Dashboard Content -->
            <div class="p-6">
                @yield('content')
            </div>
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
                        button.classList.add('text-gray-600');
                    });

                    // Add active state to clicked button
                    this.classList.add('bg-white', 'text-blue-500');
                    this.classList.remove('text-gray-600');
                });
            });
        });
    </script>
    @stack('js')
</body>

</html>
