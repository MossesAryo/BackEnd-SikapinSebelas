@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <style>
        .main-content {
            margin-left: 230px;
            padding: 0px 0 0 40px;
            justify-content: right;
            min-height: relative;
            background: #f8fafc;
            position: relative;
            z-index: 1;
        }

        .main-content::before {
            content: '';
            position: fixed;
            top: 0;
            left: 320px;
            right: 0;
            height: 100%;
            background:
                linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 30%, rgba(147, 197, 253, 0.05) 0%, transparent 50%),
                radial-gradient(ellipse at 30% 70%, rgba(96, 165, 250, 0.03) 0%, transparent 50%);
            z-index: 0;
            pointer-events: none;
        }

        .dashboard-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
        }

        .header-left h1 {
            font-size: 26px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 4px;
            background: linear-gradient(135deg, #0083ee, #0a50c1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-left p {
            color: #64748b;
            font-size: 16px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .action-btn {
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #0083ee;
            color: white;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.35);
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            transform: translateY(-2px);
        }

        .dashboard-content {
            padding: 32px;
            max-width: 1400px;
            position: relative;
            z-index: 1;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            /* ukuran dikurangi */
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
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
            transform-origin: left;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: linear-gradient(135deg, #1651af, #0083ee);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .trend-up {
            background: #dcfce7;
            color: #16a34a;
        }

        .trend-down {
            background: #fef2f2;
            color: #dc2626;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
            line-height: 1;
        }

        .stat-label {
            color: #64748b;
            font-size: 16px;
            font-weight: 500;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .chart-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
        }

        .chart-filter {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .toggle-switch {
            display: inline-flex;
            background-color: #0083ee;
            border-radius: 20px;
            padding: 2px;
            gap: 4px;
        }

        .toggle-btn {
            border: none;
            background-color: transparent;
            color: #2196f3;
            font-size: 10px;
            /* Ukuran font lebih kecil */
            padding: 6px 14px;
            /* Padding lebih kecil */
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: sans-serif;
            font-weight: 500;
        }

        .toggle-btn.active {
            background-color: white;
            color: #2196f3;
        }


        .toggle-btn:not(.active) {
            color: white;
        }


        .activity-section {
            display: grid;
            grid-template-columns: 1fr;
            /* kolom kiri 2x lebih lebar dari kanan */
            gap: 24px;
        }

        .activity-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .activity-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: 12px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .activity-item:hover {
            background: #f8fafc;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: rgb(114, 50, 50);
            flex-shrink: 0;
        }

        .activity-icon.product i {
            color: #e74c3c;
        }

        .activity-icon.user i {
            color: #3498db;
        }

        .activity-icon.apresiasi i {
            color: #2ecc71;
        }


        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: #64748b;
        }

        .activity-value {
            font-size: 14px;
            font-weight: 600;
            color: #3b82f6;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            margin-top: 24px;
        }

        .quick-actions-header {
            margin-bottom: 20px;
        }

        .quick-actions-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .quick-actions-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            text-decoration: none;
            color: #334155;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-item:hover {
            border-color: #3b82f6;
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .action-item-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .action-item-content h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .action-item-content p {
            font-size: 12px;
            color: #64748b;
        }

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
            }

            .main-content::before {
                left: 0;
            }

            .charts-section {
                grid-template-columns: 1fr;
            }

            .activity-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-content {
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header-content {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        .loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>
    </head>

    <body>
        <div class="main-content">
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <div class="header-content">
                    <div class="header-left">
                        <h1>Dashboard Wakasek</h1>
                        <p>Selamat datang kembali! Yuk, cek laporan siswa hari ini.</p>
                    </div>
                    <div class="header-actions">
                        <button class="action-btn btn-secondary">
                            <i class="bi bi-download"></i>
                            Export Data
                        </button>
                        <button class="action-btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                            Import Data
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <!-- Total Siswa -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <i class="bi bi-mortarboard-fill"></i> <!-- ikon topi wisuda -->
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="bi bi-arrow-up"></i>
                                12.5%
                            </div>
                        </div>
                        <div class="stat-value">1,580</div>
                        <div class="stat-label">Total Siswa</div>
                    </div>

                    <!-- Siswa Apresiasi -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <i class="bi bi-award-fill"></i> <!-- ikon penghargaan/apresiasi -->
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="bi bi-arrow-up"></i>
                                8.2%
                            </div>
                        </div>
                        <div class="stat-value">247</div>
                        <div class="stat-label">Siswa Apresiasi</div>
                    </div>

                    <!-- Siswa Melanggar -->
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i> <!-- ikon peringatan -->
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="bi bi-arrow-up"></i>
                                15.3%
                            </div>
                        </div>
                        <div class="stat-value">92</div>
                        <div class="stat-label">Siswa Melanggar</div>
                    </div>
                </div>


                <!-- Charts Section -->
                <div class="charts-section" style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <!-- Revenue Chart -->
                    <div class="chart-card" style="flex: 1; min-width: 300px;">
                        <div class="chart-header">
                            <h3 class="chart-title">Grafik Apresiasi Siswa</h3>
                            <div class="toggle-switch">
                                <button class="toggle-btn active">Minggu</button>
                                <button class="toggle-btn">Bulan</button>
                            </div>

                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Expense Chart -->
                    <div class="chart-card" style="flex: 1; min-width: 300px;">
                        <div class="chart-header">
                            <h3 class="chart-title">Grafik Pelanggran Siswa</h3>
                            <div class="toggle-switch">
                                <button class="toggle-btn active">Minggu</button>
                                <button class="toggle-btn">Bulan</button>
                            </div>

                        </div>
                        <div class="chart-container" style="height: 300px;">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Activity Section -->
                <div class="activity-section">
                    <div class="activity-card">
                        <div class="activity-header">
                            <h3 class="activity-title">Aktivitas Sistem Skoring</h3>
                        </div>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon user">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-text">User <strong>Andi</strong> berhasil login</div>
                                    <div class="activity-time">5 menit lalu</div>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon product">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-text">Pelanggaran oleh <strong>Rina</strong>: Datang terlambat
                                    </div>
                                    <div class="activity-time">20 menit lalu</div>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon product">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-text">Apresiasi untuk <strong>Budi</strong>: Disiplin dan aktif
                                    </div>
                                    <div class="activity-time">45 menit lalu</div>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon user">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-text">User <strong>Siti</strong> berhasil login</div>
                                    <div class="activity-time">1 jam lalu</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const dashboard = {
                    charts: {},

                    initializeCharts() {
                        // Revenue Chart - Green
                        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                        this.charts.revenueChart = new Chart(revenueCtx, {
                            type: 'bar',
                            data: {
                                labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'RPL', 'DKV', 'TJKT'],
                                datasets: [{
                                    label: 'Pendapatan',
                                    data: [120, 190, 300, 500, 200, 300, 400],
                                    backgroundColor: 'rgba(144, 238, 144, 0.7)',
                                    borderColor: 'rgba(60, 179, 113, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true
                                    }
                                }
                            }
                        });

                        // Expense Chart - Red
                        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
                        this.charts.expenseChart = new Chart(expenseCtx, {
                            type: 'bar',
                            data: {
                                labels: ['MPLB', 'AKL', 'MLOG', 'PM', 'RPL', 'DKV', 'TJKT'],
                                datasets: [{
                                    label: 'Pengeluaran',
                                    data: [100, 150, 250, 300, 180, 200, 350],
                                    backgroundColor: 'rgba(255, 182, 193, 0.7)', // pastel red
                                    borderColor: 'rgba(220, 20, 60, 1)', // deep red
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true
                                    }
                                }
                            }
                        });
                    },

                    setupEventHandlers() {
                        const filterButtons = document.querySelectorAll('.filter-btn');
                        filterButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                const type = button.getAttribute('data-type');
                                const period = button.textContent;

                                // Hapus active class hanya dari group sejenis
                                document.querySelectorAll(`.filter-btn[data-type="${type}"]`)
                                    .forEach(btn => btn.classList.remove('active'));

                                button.classList.add('active');

                                this.updateChart(type, period);
                            });
                        });
                    },

                    updateChart(type, period) {
                        let newData;
                        if (period === '7D') {
                            newData = type === 'revenue' ? [120, 190, 300, 500, 200, 300, 400] : [100, 150, 250,
                                300, 180, 200, 350
                            ];
                        } else if (period === '30D') {
                            newData = type === 'revenue' ? [320, 450, 500, 600, 550, 700, 800] : [250, 320, 400,
                                380, 390, 420, 450
                            ];
                        } else {
                            newData = type === 'revenue' ? [900, 850, 1000, 1100, 950, 1050, 1200] : [700, 600, 800,
                                750, 850, 900, 950
                            ];
                        }

                        this.charts[`${type}Chart`].data.datasets[0].data = newData;
                        this.charts[`${type}Chart`].update();
                    }
                };

                // Init
                dashboard.initializeCharts();
                dashboard.setupEventHandlers();
            });
            const buttons = document.querySelectorAll(".toggle-btn");

            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    buttons.forEach(btn => btn.classList.remove("active"));
                    button.classList.add("active");
                });
            });
        </script>
