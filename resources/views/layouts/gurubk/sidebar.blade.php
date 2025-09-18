<!-- Sidebar -->
<style>
    .dropdown-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .dropdown-content.show {
        max-height: 500px;
        /* biar muat semua */
        transition: max-height 0.3s ease-in;
    }

    .dropdown-arrow {
        transition: transform 0.3s ease;
    }

    .dropdown-arrow.rotate {
        transform: rotate(180deg);
    }

    .active-link {
        color: #2563eb !important;
        background-color: #eff6ff !important;
    }

    .menu-link.active-link:hover {
        background-color: #dbeafe;
    }

    .sidebar-nav::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<div class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-10 flex flex-col">
    <!-- Fixed Header -->
    <div class="p-6 flex-shrink-0 border-b border-gray-100">
        <!-- Logo -->
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

    <!-- Scrollable Navigation -->
    <div class="flex-1 overflow-y-auto sidebar-nav">
        <nav class="p-6 pt-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('gurubk.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('gurubk.dashboard') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Siswa -->
                <li>
                    <a href="{{ route('gurubk.jurusan') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('gurubk.jurusan*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-person"></i>
                        <span>Siswa</span>
                    </a>
                </li>

                <!-- FAQ Dropdown -->
                <li>
                    <button onclick="toggleDropdown('faqDropdown','faqArrow')"
                        class="flex items-center justify-between w-full px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-question-circle"></i>
                            <span>FAQ</span>
                        </div>
                        <i class="bi bi-chevron-down dropdown-arrow text-sm" id="faqArrow"></i>
                    </button>
                    <div id="faqDropdown"
                        class="dropdown-content ml-4 mt-1
                        {{ request()->routeIs('penghargaanbk.*') || request()->routeIs('peringatanbk.*') || request()->routeIs('aspek_penghargaanBK.*') || request()->routeIs('aspek_pelanggaranBK.*') ? 'show' : '' }}">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('penghargaanbk.index') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('penghargaanbk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-award"></i>
                                    <span>Penghargaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('peringatanbk.index') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('peringatanbk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <span>Pelanggaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspek_penghargaanBK.index') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('aspek_penghargaanBK.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-stars"></i>
                                    <span>Aspek Penghargaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspek_pelanggaranBK.index') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('aspek_pelanggaranBK.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-x-circle"></i>
                                    <span>Aspek Pelanggaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Skoring Penghargaan -->
                <li>
                    <a href="{{ route('skoring_penghargaanBK.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('skoring_penghargaanBK.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-people"></i>
                        <span>Skoring Penghargaan</span>
                    </a>
                </li>

                <!-- Skoring Pelanggaran -->
                <li>
                    <a href="{{ route('skoring_pelanggaranBK.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('skoring_pelanggaranBK.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-people"></i>
                        <span>Skoring Pelanggaran</span>
                    </a>
                </li>

                <!-- Intervensi -->
                <li>
                    <a href="{{ route('intervensi.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('intervensi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-award"></i>
                        <span>Intervensi</span>
                    </a>
                </li>

                <!-- Akumulasi -->
                <li>
                    <a href="{{ route('akumulasiBK') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('akumulasiBK') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-bar-chart"></i>
                        <span>Akumulasi</span>
                    </a>
                </li>



            </ul>
        </nav>
    </div>
</div>

<script>
    // Toggle dropdown generic
    function toggleDropdown(dropdownId, arrowId) {
        const dropdown = document.getElementById(dropdownId);
        const arrow = document.getElementById(arrowId);

        dropdown.classList.toggle('show');
        arrow.classList.toggle('rotate');
    }

    // Close dropdown kalau klik di luar
    document.addEventListener("click", function(event) {
        const dropdowns = [{
            btn: "faqArrow",
            content: "faqDropdown"
        }];
        dropdowns.forEach(d => {
            const dropdown = document.getElementById(d.content);
            const arrow = document.getElementById(d.btn);
            if (!event.target.closest(`#${d.content}`) && !event.target.closest(`#${d.btn}`) && !event
                .target.closest("button")) {
                dropdown.classList.remove("show");
                arrow.classList.remove("rotate");
            }
        });
    });

    // Initialize and handle scrolling
    document.addEventListener("DOMContentLoaded", () => {
        const sidebarScrollArea = document.querySelector('.sidebar-nav');

        // Prevent body scroll when scrolling inside sidebar
        if (sidebarScrollArea) {
            sidebarScrollArea.addEventListener('wheel', (e) => {
                const {
                    scrollTop,
                    scrollHeight,
                    clientHeight
                } = sidebarScrollArea;
                const isScrollingDown = e.deltaY > 0;
                const isAtTop = scrollTop === 0;
                const isAtBottom = scrollTop + clientHeight >= scrollHeight;

                // Only prevent default if we can scroll in the sidebar
                if ((isScrollingDown && !isAtBottom) || (!isScrollingDown && !isAtTop)) {
                    e.stopPropagation();
                }
            });
        }

        // Check if any dropdown item is active and open the dropdown
        const faqDropdown = document.getElementById('faqDropdown');
        const faqArrow = document.getElementById('faqArrow');

        if (faqDropdown && faqDropdown.classList.contains('show')) {
            faqArrow.classList.add('rotate');
        }

        // Ensure active links maintain proper styling
        document.querySelectorAll('.active-link').forEach(link => {
            link.classList.remove('text-gray-600');
        });
    });
</script>
