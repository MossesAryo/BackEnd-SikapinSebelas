<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikapin-Sistem Skoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #334155;
            overflow-x: hidden;
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

        .sidebar {
            width: 270px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .header-section {
            padding: 25px 28px 15px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 1px solid rgba(59, 130, 246, 0.08);
            position: relative;
        }

        .header-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 28px;
            right: 28px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), transparent);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0083ee 0%, #0083ee 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .brand-logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .brand-logo:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }

        .brand-logo:hover::before {
            left: 100%;
        }

        .brand-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: white;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand-icon:hover {
            transform: scale(1.1) rotate(-10deg);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
        }

        .brand-info {
            flex: 1;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 4px;
            border-left: #1e293b;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .brand-tagline {
            font-size: 12px;
            opacity: 0.9;
            font-weight: 500;
        }

        .header-stats {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 11px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Navigation Section */
        .nav-section {
            flex: 1;
            padding: 32px 0;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .nav-section::-webkit-scrollbar {
            display: none;
        }

        .nav-category {
            margin-bottom: 40px;
            padding: 0 24px;
        }

        .nav-category:last-child {
            margin-bottom: 0;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding: 0 8px;
        }

        .category-icon {
            width: 24px;
            height: 24px;
            background: #0083ee;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .category-title {
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .category-line {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, #e2e8f0, transparent);
            border-radius: 1px;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 18px 24px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            margin: 0 8px;
            background: transparent;
            border: 2px solid transparent;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 197, 253, 0.05));
            border-radius: 18px;
            transition: width 0.3s ease;
            z-index: -1;
        }

        .nav-link:hover {
            color: #1e40af;
            transform: translateX(12px);
            background: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.1);
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .nav-link.active {
            background: #0083ee;
            color: white;
            font-weight: 600;
            transform: translateX(0);
            border-color: ##0083ee;
            box-shadow:
                0 10px 25px rgba(59, 130, 246, 0.3),
                0 4px 10px rgba(59, 130, 246, 0.2);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            left: -32px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 40px;
            background: #0083ee;
            border-radius: 0 8px 8px 0;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .nav-icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .nav-link.active .nav-icon {
            transform: scale(1.15);
            filter: drop-shadow(0 2px 4px rgba(255, 255, 255, 0.3));
        }

        .nav-text {
            flex: 1;
        }

        .nav-count {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 14px;
            min-width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .nav-link.active .nav-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.2);
        }

        /* Footer Section */
        .footer-section {
            padding: 28px 32px 36px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-top: 1px solid #e2e8f0;
        }

        .user-info {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .user-info::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            animation: rotate 3s linear infinite;
        }

        .user-info:hover {
            border-color: #0083ee;
            box-shadow: 0 12px 32px rgba(59, 130, 246, 0.15);
            transform: translateY(-4px);
        }

        .user-info:hover::before {
            opacity: 1;
        }

        .user-picture {
            width: 60px;
            height: 60px;
            background: #0083ee;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        }

        .user-picture::after {
            content: '';
            position: absolute;
            bottom: -3px;
            right: -3px;
            width: 18px;
            height: 18px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4);
        }

        .user-data {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .user-name {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .user-position {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .control-buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .control-btn {
            width: 48px;
            height: 48px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .control-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1), transparent 70%);
            border-radius: 50%;
            transition: all 0.4s ease;
            transform: translate(-50%, -50%);
        }

        .control-btn:hover {
            background: linear-gradient(135deg, #f0f9ff, #dbeafe);
            border-color: #0083ee;
            color: #1e40af;
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.25);
        }

        .control-btn:hover::before {
            width: 100px;
            height: 100px;
        }

        /* Tooltip */
        .tooltip {
            position: absolute;
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            z-index: 1000;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .tooltip::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 12px;
            height: 12px;
            background: #1e293b;
            border-radius: 2px;
            transform: translateX(-50%) rotate(45deg);
        }

        .tooltip.show {
            opacity: 1;
            transform: translateY(0);
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

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* Entrance animations */
        .nav-link {
            opacity: 0;
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .nav-link:nth-child(1) {
            animation-delay: 0.1s;
        }

        .nav-link:nth-child(2) {
            animation-delay: 0.15s;
        }

        .nav-link:nth-child(3) {
            animation-delay: 0.2s;
        }

        .nav-link:nth-child(4) {
            animation-delay: 0.25s;
        }

        .nav-link:nth-child(5) {
            animation-delay: 0.3s;
        }

        .nav-link:nth-child(6) {
            animation-delay: 0.35s;
        }

        .nav-link:nth-child(7) {
            animation-delay: 0.4s;
        }

        .nav-link:nth-child(8) {
            animation-delay: 0.45s;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }

        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .loading .nav-icon {
            animation: bounce 1.2s ease-in-out infinite;
        }

        /* Focus states for accessibility */
        .nav-link:focus,
        .user-info:focus,
        .control-btn:focus {
            outline: 3px solid rgba(59, 130, 246, 0.5);
            outline-offset: 3px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <!-- Header Section -->
        <div class="header-section">
            <div class="brand">
                <div class="brand-logo" id="brandLogo">
                    <i class="bi bi-journal-check"></i>
                </div>
                <div class="brand-content">
                    <div class="brand-title">Sikapin</div>
                </div>
            </div>
        </div>
        <!-- Navigation Section -->
        <div class="nav-section">
            <!-- Overview -->
            <div class="nav-category">
                <div class="category-header">
                    <div class="category-icon"><i class="bi bi-speedometer2"></i></div>
                    <div class="category-title">Overview</div>

                </div>
                <div class="nav-list">
                    <a href="{{ route('wakasek.dashboard') }}"
                        class="nav-link {{ Request::routeIs('wakasek.dashboard') ? 'active' : '' }}"> <span
                            class="nav-icon"><i class="bi bi-house-door"></i></span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Laporan -->
            <div class="nav-category">
                <div class="category-header">
                    <div class="category-icon"><i class="bi bi-clipboard-data"></i></div>
                    <div class="category-title">Laporan</div>
                </div>
                <a href="{{ route('wakasek.laporanjammalam') }}"
                    class="nav-link {{ Request::routeIs('wakasek.laporanjammalam') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="bi bi-clock-history"></i></span>
                    <span class="nav-text">Laporan Jam Malam</span>
                </a>
            </div>

            <!-- Penilaian -->
            <div class="nav-category">
                <div class="category-header">
                    <div class="category-icon"><i class="bi bi-pencil-square"></i></div>
                    <div class="category-title">Penilaian</div>
                </div>
                <div class="nav-list">
                  <a href="{{ route('wakasek.penilaian') }}"
                        class="nav-link {{ Request::routeIs('wakasek.penilaian') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="bi bi-bar-chart-line"></i></span>
                        <span class="nav-text">Penilaian</span>
                    </a>
                </div>
            </div>

            <!-- Referensi -->
            <div class="nav-category">
                <div class="category-header">
                    <div class="category-icon"><i class="bi bi-journal-bookmark"></i></div>
                    <div class="category-title">Referensi</div>
                </div>
                <div class="nav-list">
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-lightbulb"></i></span>
                        <span class="nav-text">Indikator</span>
                    </a>
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-award"></i></span>
                        <span class="nav-text">Predikat</span>
                    </a>
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-people"></i></span>
                        <span class="nav-text">Rombel</span>
                    </a>
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-person-badge"></i></span>
                        <span class="nav-text">Guru</span>
                    </a>
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-diagram-3"></i></span>
                        <span class="nav-text">Guru Rombel</span>
                    </a>
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-person"></i></span>
                        <span class="nav-text">Murid</span>
                    </a>
                    <a href="#" class="nav-link" data-page="referensi">
                        <span class="nav-icon"><i class="bi bi-people-fill"></i></span>
                        <span class="nav-text">Anggota Rombel</span>
                    </a>
                </div>
            </div>

            <!-- Pengguna -->
            <div class="nav-category">
                <div class="category-header">
                    <div class="category-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div class="category-title">Pengguna</div>
                </div>
                <div class="nav-list">
                    <a href="#" class="nav-link" data-page="customers">
                        <span class="nav-icon"><i class="bi bi-person-vcard"></i></span>
                        <span class="nav-text">Pengguna</span>
                    </a>
                    <a href="#" class="nav-link" data-page="reports">
                        <span class="nav-icon"><i class="bi bi-journal-text"></i></span>
                        <span class="nav-text">Reports</span>
                    </a>
                </div>
                <a href="/logout">Logout</a>

            </div>
        </div>

    </div>
    <div class="tooltip" id="tooltip"></div>


    <div class="main-content">
        @yield('content')
    </div>



    <script>
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Hapus semua 'active' dari nav-link
                navLinks.forEach(l => l.classList.remove('active'));

                // Tambahkan 'active' ke link yang diklik
                this.classList.add('active');
            });
        });
        class AdvancedSidebar {
            constructor() {
                this.tooltip = document.getElementById('tooltip');
                this.activePage = 'orders';
                this.stats = {
                    products: 127,
                    orders: 8,
                    revenue: 2400
                };
                this.init();
            }

            init() {
                this.setupEventHandlers();
                this.initializeTooltips();
                this.startStatUpdates();
                this.setupBrandInteraction();
                this.setupKeyboardShortcuts();
                this.animateEntrance();
            }

            setupEventHandlers() {
                // Navigation links
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', (e) => this.handleNavigation(e, link));
                    link.addEventListener('mouseenter', (e) => this.handleNavHover(e, link));
                    link.addEventListener('mouseleave', (e) => this.handleNavLeave(e, link));
                });

                // Control buttons
                document.querySelectorAll('.control-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => this.handleControlAction(e, btn));
                });

                // User info
                document.getElementById('userInfo').addEventListener('click', () => {
                    this.handleUserProfileClick();
                });

                // Brand icon
                document.getElementById('brandIcon').addEventListener('click', () => {
                    this.handleBrandClick();
                });
            }

            handleNavigation(e, link) {
                e.preventDefault();

                const page = link.dataset.page;
                if (page === this.activePage) return;

                // Remove active state
                document.querySelectorAll('.nav-link').forEach(nav => {
                    nav.classList.remove('active');
                });

                // Add loading state
                link.classList.add('loading');

                setTimeout(() => {
                    link.classList.remove('loading');
                    link.classList.add('active');
                    this.activePage = page;
                    this.updateStats(page);
                    this.createNavigationRipple(e, link);
                    this.showPageTransition();
                }, 500);
            }

            handleNavHover(e, link) {
                if (!link.classList.contains('active')) {
                    this.createHoverGlow(link);
                }
            }

            handleNavLeave(e, link) {
                this.removeHoverGlow(link);
            }

            createNavigationRipple(e, element) {
                const ripple = document.createElement('div');
                const rect = element.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height) * 1.2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${e.clientX - rect.left - size/2}px;
                    top: ${e.clientY - rect.top - size/2}px;
                    background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: navigationRipple 0.8s cubic-bezier(0.4, 0, 0.2, 1);
                    pointer-events: none;
                    z-index: 100;
                `;

                element.style.position = 'relative';
                element.appendChild(ripple);

                const style = document.createElement('style');
                style.textContent = `
                    @keyframes navigationRipple {
                        to {
                            transform: scale(1.5);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);

                setTimeout(() => {
                    ripple.remove();
                    style.remove();
                }, 800);
            }

            createHoverGlow(element) {
                const glow = document.createElement('div');
                glow.className = 'nav-glow';
                glow.style.cssText = `
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(147, 197, 253, 0.04));
                    border-radius: 18px;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                    pointer-events: none;
                    z-index: -1;
                `;

                element.style.position = 'relative';
                element.appendChild(glow);

                requestAnimationFrame(() => glow.style.opacity = '1');
            }

            removeHoverGlow(element) {
                const glow = element.querySelector('.nav-glow');
                if (glow) {
                    glow.style.opacity = '0';
                    setTimeout(() => glow.remove(), 300);
                }
            }

            showPageTransition() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.style.transform = 'scale(0.98)';
                sidebar.style.opacity = '0.9';

                setTimeout(() => {
                    sidebar.style.transform = 'scale(1)';
                    sidebar.style.opacity = '1';
                }, 250);
            }

            initializeTooltips() {
                document.querySelectorAll('[data-tooltip]').forEach(el => {
                    el.addEventListener('mouseenter', (e) => {
                        const tooltipText = el.getAttribute('data-tooltip');
                        this.showTooltip(tooltipText, e.target);
                    });

                    el.addEventListener('mouseleave', () => {
                        this.hideTooltip();
                    });
                });
            }

            showTooltip(text, element) {
                if (!this.tooltip) return;

                this.tooltip.textContent = text;
                const rect = element.getBoundingClientRect();
                const offset = 10;

                this.tooltip.style.display = 'block';
                this.tooltip.style.top = `${rect.top + window.scrollY + rect.height + offset}px`;
                this.tooltip.style.left = `${rect.left + window.scrollX}px`;
                this.tooltip.style.opacity = '1';
            }

            hideTooltip() {
                if (!this.tooltip) return;
                this.tooltip.style.opacity = '0';
                setTimeout(() => {
                    this.tooltip.style.display = 'none';
                }, 200);
            }
    </script>
</body>

</html>
