<!-- Sidebar -->
<style>
    .dropdown-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .dropdown-content.show {
        max-height: 500px;
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

<div class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-20 flex flex-col">
    <!-- Fixed Header -->
    <div class="p-6 flex-shrink-0 border-b border-gray-100">
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
                    <a href="{{ route('wakasek.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('wakasek.dashboard') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                


                    @if (auth()->user()->role == 3)
                    <li>
                        <a href="{{ route('ketua_program.siswa') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    {{ request()->routeIs('siswa.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="bi bi-person-badge"></i>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ketua_program.kelas') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    {{ request()->routeIs('kelas*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="bi bi-grid-3x3-gap"></i>
                            <span>Kelas</span>
                        </a>
                    </li>
                    @endif

                      @if (auth()->user()->role == 4)
                    <li>
                        <a href="{{ route('walikelas.siswa') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    {{ request()->routeIs('siswa.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="bi bi-person-badge"></i>
                            <span>Siswa</span>
                        </a>
                    </li>
                    @endif

                @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                <li>
                    <a href="{{ route('siswa.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('siswa.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-person-badge"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                   {{ request()->routeIs('kelas*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Kelas</span>
                    </a>
                </li>

                    <!-- User Dropdown -->
                    <li>
                        <button onclick="toggleDropdown('userDropdown','userArrow')"
                            class="flex items-center justify-between w-full px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <i class="bi bi-people-fill"></i>
                                <span>User</span>
                            </div>
                            <i class="bi bi-chevron-down dropdown-arrow text-sm" id="userArrow"></i>
                        </button>
                        <div id="userDropdown"
                            class="dropdown-content ml-4 mt-1
                        {{ request()->routeIs('walikelas.*') || request()->routeIs('gurubk.*') || request()->routeIs('kaprog.*') ? 'show' : '' }}">
                            <ul class="space-y-1">
                                <li>
                                    <a href="{{ route('walikelas.index') }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('walikelas.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                        <i class="bi bi-person-vcard"></i>
                                        <span>Wali Kelas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('gurubk.index') }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('gurubk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                        <i class="bi bi-person-hearts"></i>
                                        <span>Guru BK</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kaprog.index') }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   {{ request()->routeIs('kaprog.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                                        <i class="bi bi-mortarboard"></i>
                                        <span>Kaprog</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('penghargaan.index') }}"
                        class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                        {{ request()->routeIs('penghargaan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-trophy"></i>
                        <span>Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('peringatan.index') }}"
                    class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                    {{ request()->routeIs('peringatan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="bi bi-shield-exclamation"></i>
                    <span>Pelanggaran</span>
                </a>
            </li>
            @endif



                <li>
                    <a href="{{ route('aspek_penghargaan.index') }}"
                        class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                                   {{ request()->routeIs('aspek_penghargaan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-star-fill"></i>
                        <span>Aspek Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('aspek_pelanggaran.index') }}"
                        class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                                   {{ request()->routeIs('aspek_pelanggaran.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-x-octagon"></i>
                        <span>Aspek Pelanggaran</span>
                    </a>
                </li>




                <!-- Skoring Penghargaan -->
                <li>
                    <a href="{{ route('skoring_penghargaan.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('skoring_penghargaan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-clipboard-check"></i>
                        <span>Skoring Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('skoring_pelanggaran.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('skoring_pelanggaran.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-clipboard-x"></i>
                        <span>Skoring Pelanggaran</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('akumulasi.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    {{ request()->routeIs('akumulasi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-graph-up"></i>
                        <span>Akumulasi</span>
                    </a>
                </li>
                
                @if (auth()->user()->role == 1 || auth()->user()->role == 2  || auth()->user()->role == 4)
                    
                <li>
                    <a href="{{ route('intervensi.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    {{ request()->routeIs('intervensi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="bi bi-life-preserver"></i>
                    <span>Penanganan</span>
                </a>
            </li>
         @endif


            <li>
                <a href="{{ route('statusintervensi.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                {{ request()->routeIs('statusintervensi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="bi bi-clipboard-data"></i>
                <span>Status Penanganan</span>
            </a>
        </li>
    


                <li>
                    <a href="{{ route('laporan.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       {{ request()->routeIs('laporan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>laporan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    function toggleDropdown(dropdownId, arrowId) {
        const dropdown = document.getElementById(dropdownId);
        const arrow = document.getElementById(arrowId);

        dropdown.classList.toggle('show');
        arrow.classList.toggle('rotate');
    }

    // Close dropdown kalau klik di luar
    document.addEventListener("click", function(event) {
        const dropdowns = [{
                btn: "userArrow",
                content: "userDropdown"
            },
            {
                btn: "faqArrow",
                content: "faqDropdown"
            }
        ];

        dropdowns.forEach(d => {
            const dropdown = document.getElementById(d.content);
            const arrow = document.getElementById(d.btn);

            // Pastikan elemen benar-benar ada
            if (!dropdown || !arrow) return;

            if (!event.target.closest(`#${d.content}`) &&
                !event.target.closest(`#${d.btn}`) &&
                !event.target.closest("button")) {
                dropdown.classList.remove("show");
                arrow.classList.remove("rotate");
            }
        });
    });



    document.addEventListener("DOMContentLoaded", () => {
        const sidebarScrollArea = document.querySelector('.sidebar-nav');


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


                if ((isScrollingDown && !isAtBottom) || (!isScrollingDown && !isAtTop)) {
                    e.stopPropagation();
                }
            });
        }


        const userDropdown = document.getElementById('userDropdown');
        const userArrow = document.getElementById('userArrow');
        const faqDropdown = document.getElementById('faqDropdown');
        const faqArrow = document.getElementById('faqArrow');

        if (userDropdown && userDropdown.classList.contains('show')) {
            userArrow.classList.add('rotate');
        }

        if (faqDropdown && faqDropdown.classList.contains('show')) {
            faqArrow.classList.add('rotate');
        }


        const currentPath = window.location.pathname;
        document.querySelectorAll(".menu-link").forEach(link => {
            const href = link.getAttribute("href");
            if (href && href !== "#" && currentPath.includes(href)) {
                link.classList.add("active-link");
                link.classList.remove("text-gray-600");

                // Open parent dropdown if link is inside one
                const dropdownContent = link.closest(".dropdown-content");
                if (dropdownContent) {
                    dropdownContent.classList.add("show");
                    const button = dropdownContent.previousElementSibling;
                    const arrow = button.querySelector(".dropdown-arrow");
                    if (arrow) arrow.classList.add("rotate");
                }
            }
        });
    });
</script>
