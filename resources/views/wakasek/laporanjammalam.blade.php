@extends('layouts.wakasek.app')

@section('title', 'Laporan Jam Malam')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, transparent 50%),
                radial-gradient(ellipse at 30% 20%, rgba(147, 197, 253, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 80%, rgba(96, 165, 250, 0.08) 0%, transparent 50%);
            z-index: -1;
        }

        .main-content {
            margin-left: 270px;
            padding: 40px 50px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 32px;
            padding: 40px 50px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(59, 130, 246, 0.05), transparent);
            opacity: 0.7;
            animation: rotate 20s linear infinite;
        }

        .page-header-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .page-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0083ee, #0066cc);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            box-shadow: 0 12px 24px rgba(59, 130, 246, 0.3);
        }

        .page-title-text h1 {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #1e293b, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title-text p {
            font-size: 16px;
            color: #64748b;
            font-weight: 500;
        }

        .page-actions {
            display: flex;
            gap: 16px;
        }

        .action-btn {
            padding: 16px 28px;
            background: linear-gradient(135deg, #0083ee, #0066cc);
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        .action-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 32px rgba(59, 130, 246, 0.4);
        }

        .action-btn.secondary {
            background: white;
            color: #64748b;
            border: 2px solid #e2e8f0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .action-btn.secondary:hover {
            background: #f8fafc;
            border-color: #0083ee;
            color: #0083ee;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #0083ee, #0066cc);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.1);
        }

        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-card-title {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0083ee, #0066cc);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .stat-card-value {
            font-size: 36px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .stat-card-change {
            font-size: 14px;
            font-weight: 600;
            color: #16a34a;
        }

        /* Filters Section */
        .filters-section {
            background: white;
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 32px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
        }

        .filters-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .filters-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 24px;
            align-items: end;
        }

        .filter-group {
            position: relative;
        }

        .filter-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 16px;
            background: white;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #0083ee;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .date-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 16px;
            background: white;
            transition: all 0.3s ease;
        }

        .date-input:focus {
            outline: none;
            border-color: #0083ee;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .filter-btn {
            padding: 16px 24px;
            background: linear-gradient(135deg, #0083ee, #0066cc);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        /* Table Container */
        .table-container {
            background: white;
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        }

        .table-header {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 24px 32px;
            border-bottom: 2px solid rgba(59, 130, 246, 0.1);
        }

        .table-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table tr {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s ease;
        }

        .data-table tr:hover {
            background: rgba(59, 130, 246, 0.02);
        }

        .data-table td {
            padding: 24px 32px;
            vertical-align: middle;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .student-avatar {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 700;
            position: relative;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .student-avatar::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            border-radius: 22px;
            z-index: -1;
        }

        .student-details {
            flex: 1;
        }

        .student-name {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .violation-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #dc2626;
            font-size: 14px;
            font-weight: 500;
        }

        .time-badge {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            min-width: 80px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.violation {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .status-badge.late {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-badge.normal {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            color: #64748b;
        }

        .empty-state-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #94a3b8;
            margin: 0 auto 24px;
        }

        .empty-state h3 {
            font-size: 24px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 32px;
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0083ee, #0066cc);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
            z-index: 1000;
        }

        .fab:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 32px rgba(59, 130, 246, 0.5);
        }

        /* Animations */
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
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

        /* Animation delays for cards */
        .stat-card:nth-child(1) {
            animation: fadeInUp 0.6s ease 0.1s both;
        }

        .stat-card:nth-child(2) {
            animation: fadeInUp 0.6s ease 0.2s both;
        }

        .stat-card:nth-child(3) {
            animation: fadeInUp 0.6s ease 0.3s both;
        }

        .stat-card:nth-child(4) {
            animation: fadeInUp 0.6s ease 0.4s both;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 270px;
                padding: 32px;
            }

            .page-header {
                padding: 32px 40px;
            }

            .filters-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .page-header-content {
                flex-direction: column;
                gap: 24px;
                text-align: center;
            }

            .page-actions {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .student-info {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }

            .data-table td {
                padding: 16px 20px;
            }

            .filters-section {
                padding: 24px;
            }

            .page-header {
                padding: 24px;
            }
        }
    </style>
    </head>

    <body>
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <div class="page-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="page-title-text">
                            <h1>Laporan Jam Malam</h1>
                            <p>Semester Ganjil 2025/2026</p>
                        </div>
                    </div>
                    <div class="page-actions">
                        <button class="action-btn secondary">
                            <i class="bi bi-download"></i>
                            Export PDF
                        </button>
                        <button class="action-btn">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Laporan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-title">Total Pelanggaran</span>
                        <div class="stat-card-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div class="stat-card-value">24</div>
                    <div class="stat-card-change">+12% dari bulan lalu</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-title">Siswa Terlibat</span>
                        <div class="stat-card-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <div class="stat-card-value">16</div>
                    <div class="stat-card-change">+8% dari bulan lalu</div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-title">Rata-rata Waktu</span>
                        <div class="stat-card-icon">
                            <i class="bi bi-alarm"></i>
                        </div>
                    </div>
                    <div class="stat-card-value">22:45</div>
                    <div class="stat-card-change">-15 min dari bulan lalu</div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-header">
                    <i class="bi bi-funnel"></i>
                    <h3>Filter & Pencarian</h3>
                </div>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label" for="search">Cari Nama Siswa</label>
                        <div class="search-input-wrapper">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" id="search" class="search-input" placeholder="Masukkan nama siswa...">
                        </div>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label" for="date">Tanggal</label>
                        <input type="date" id="date" class="date-input">
                    </div>

                    <button class="filter-btn">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>
                </div>
            </div>

            <!-- Table Container -->
            <div class="table-container">
                <div class="table-header">
                    <h3>
                        <i class="bi bi-list-ul"></i>
                        Daftar Pelanggaran Jam Malam
                    </h3>
                </div>

                <div class="table-wrapper">
                    <table class="data-table">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar"
                                            style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                                            AP
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">Agam Pratama</div>
                                            <div class="violation-info">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                Keluar tanpa izin
                                            </div>
                                        </div>
                                        <div class="time-badge">22:14</div>
                                        <div class="status-badge violation">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Pelanggaran
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar"
                                            style="background: linear-gradient(135deg, #00bcd4, #0097a7);">
                                            AN
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">Aditya Nurhidayat</div>
                                            <div class="violation-info">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                Keluar tanpa izin
                                            </div>
                                        </div>
                                        <div class="time-badge">23:01</div>
                                        <div class="status-badge violation">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Pelanggaran
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar"
                                            style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                                            PA
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">Putri Ayu</div>
                                            <div class="violation-info">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                Keluar tanpa izin
                                            </div>
                                        </div>
                                        <div class="time-badge">21:55</div>
                                        <div class="status-badge late">
                                            <i class="bi bi-clock"></i>
                                            Terlambat
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar"
                                            style="background: linear-gradient(135deg, #2ecc71, #27ae60);">
                                            PW
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">Pranata Wijaya</div>
                                            <div class="violation-info">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                Keluar tanpa izin
                                            </div>
                                        </div>
                                        <div class="time-badge">00:05</div>
                                        <div class="status-badge violation">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Pelanggaran
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar"
                                            style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                                            RS
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">Rina Sari</div>
                                            <div class="violation-info">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                Keluar tanpa izin
                                            </div>
                                        </div>
                                        <div class="time-badge">22:30</div>
                                        <div class="status-badge violation">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Pelanggaran
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar"
                                            style="background: linear-gradient(135deg, #3498db, #2980b9);">
                                            DS
                                        </div>
                                        <div class="student-details">
                                            <div class="student-name">Doni Saputra</div>
                                            <div class="violation-info">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                                Keluar tanpa izin
                                            </div>
                                        </div>
                                        <div class="time-badge">23:15</div>
                                        <div class="status-badge violation">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Pelanggaran
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Floating Action Button -->
            <div class="fab" title="Refresh Data">
                <i class="bi bi-arrow-clockwise"></i>
            </div>
        </div>

        <script>
            // Search functionality
            document.getElementById('search').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('.data-table tbody tr');

                rows.forEach(row => {
                    const studentName = row.querySelector('.student-name').textContent.toLowerCase();
                    if (studentName.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Date filter functionality
            document.getElementById('date').addEventListener('change', function(e) {
                console.log('Filter by date:', e.target.value);
                // Add your date filtering logic here
            });

            // Filter button
            document.querySelector('.filter-btn').addEventListener('click', function() {
                        const searchTerm = document.getElementById('search').value;
                        const selectedDate = document.getElementById('date').value;

                        console.log('
