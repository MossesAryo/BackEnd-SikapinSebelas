<!-- Sidebar -->
<style>
    .dropdown-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    .dropdown-content.show {
        max-height: 500px; /* biar muat semua */
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
</style>

<div class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-10">
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

        <!-- Navigation Menu -->
        <nav class="mt-8">
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
                <li>
                    <a href="{{ route('gurubk.siswa') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-lg menu-link 
                       {{ request()->routeIs('gurubk.siswa*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-person"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-lg menu-link 
                       {{ request()->routeIs('kelas*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-people"></i>
                        <span>Kelas</span>
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
                    <div id="faqDropdown" class="dropdown-content ml-4 mt-1
                        {{ request()->routeIs('penghargaan.*') || request()->routeIs('peringatan.*') || request()->routeIs('aspek_penghargaan.*') || request()->routeIs('aspek_pelanggaran.*') ? 'show' : '' }}">
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
                                   {{ request()->routeIs('peringatan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <span>Pelanggaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspek_penghargaanBK.index') }}" 
                                   class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link 
                                   {{ request()->routeIs('aspek_penghargaanbk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-stars"></i>
                                    <span>Aspek Penghargaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspek_pelanggaranBK.index') }}" 
                                   class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link 
                                   {{ request()->routeIs('aspek_pelanggaranbk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="bi bi-x-circle"></i>
                                    <span>Aspek Pelanggaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Sisanya -->
                <li>
                    <a href="{{ route('skoring_penghargaanBK.index') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-lg menu-link 
                       {{ request()->routeIs('skoring_penghargaanBK.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-people"></i>
                        <span>Skoring Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('skoring_pelanggaranBK.index') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-lg menu-link
                       {{ request()->routeIs('skoring_pelanggaran.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-people"></i>
                        <span>Skoring Pelanggaran</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('intervensi.index') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-lg menu-link 
                       {{ request()->routeIs('intervensi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-award"></i>
                        <span>intervensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('akumulasiBK') }}" 
                       class="flex items-center gap-3 px-3 py-3 rounded-lg menu-link 
                       {{ request()->routeIs('akumulasibk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
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
        const dropdowns = [
            {btn: "userArrow", content: "userDropdown"},
            {btn: "faqArrow", content: "faqDropdown"}
        ];
        dropdowns.forEach(d => {
            const dropdown = document.getElementById(d.content);
            const arrow = document.getElementById(d.btn);
            if (!event.target.closest(`#${d.content}`) && !event.target.closest(`#${d.btn}`) && !event.target.closest("button")) {
                dropdown.classList.remove("show");
                arrow.classList.remove("rotate");
            }
        });
    });

    // JS Fallback aktifkan link berdasarkan pathname
    document.addEventListener("DOMContentLoaded", () => {
        const currentPath = window.location.pathname;
        document.querySelectorAll(".menu-link").forEach(link => {
            const href = link.getAttribute("href");
            if (href && href !== "#" && currentPath.includes(href)) {
                link.classList.add("active-link", "text-blue-600", "bg-blue-50");
                link.classList.remove("text-gray-600");
            }
        });
    });
</script>
