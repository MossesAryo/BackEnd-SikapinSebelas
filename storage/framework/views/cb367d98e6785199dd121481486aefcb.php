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
    <img src="<?php echo e(asset('storage/assets/logo.png')); ?>" alt="SIJUWARA" class="w-10 h-10 object-contain">
    <div>
        <h1 class="text-lg font-extrabold tracking-wide" style="color: #1e3a5f;">SIJUWARA</h1>
        <p class="text-xs font-medium" style="color: #4a7ab5;">(Sistem Jurnal Siswa Aktif)</p>
    </div>
</div>
    </div>

    <!-- Scrollable Navigation -->
    <div class="flex-1 overflow-y-auto sidebar-nav">
        <nav class="p-6 pt-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="<?php echo e(route('wakasek.dashboard')); ?>"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       <?php echo e(request()->routeIs('wakasek.dashboard') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

              
                    <li>
                        <a href="<?php echo e(route('siswa.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       <?php echo e(request()->routeIs('siswa.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                            <i class="bi bi-person-badge"></i>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('kelas')); ?>"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                   <?php echo e(request()->routeIs('kelas*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                            <i class="bi bi-grid-3x3-gap"></i>
                            <span>Kelas</span>
                        </a>
                    </li>

                    <!-- User Dropdown -->
                    <?php if(auth()->user()->role == 1): ?>
                        <li>
                            <button onclick="toggleDropdown('userDropdown','userArrow')"
                                class="flex items-center justify-between w-full px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <i class="bi bi-people"></i>
                                    <span>User</span>
                                </div>
                                <i class="bi bi-chevron-down dropdown-arrow text-sm" id="userArrow"></i>
                            </button>
                            <div id="userDropdown"
                                class="dropdown-content ml-4 mt-1
                        <?php echo e(request()->routeIs('walikelas.*') || request()->routeIs('gurubk.*') || request()->routeIs('kaprog.*') ? 'show' : ''); ?>">
                                <ul class="space-y-1">
                                    <li>
                                        <a href="<?php echo e(route('walikelas.index')); ?>"
                                            class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   <?php echo e(request()->routeIs('walikelas.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                            <i class="bi bi-person-vcard"></i>
                                            <span>Wali Kelas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('gurubk.index')); ?>"
                                            class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   <?php echo e(request()->routeIs('gurubk.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                            <i class="bi bi-person-hearts"></i>
                                            <span>Guru BK</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('kaprog.index')); ?>"
                                            class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg menu-link
                                   <?php echo e(request()->routeIs('kaprog.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                            <i class="bi bi-mortarboard"></i>
                                            <span>Kaprog</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->role == 1): ?>
                        <li>
                            <a href="<?php echo e(route('penghargaan.index')); ?>"
                                class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                        <?php echo e(request()->routeIs('penghargaan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                <i class="bi bi-trophy"></i>
                                <span>Penghargaan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('peringatan.index')); ?>"
                                class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                    <?php echo e(request()->routeIs('peringatan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                                <i class="bi bi-shield-exclamation"></i>
                                <span>Pelanggaran</span>
                            </a>
                        </li>
                    <?php endif; ?>
           



                <li>
                    <a href="<?php echo e(route('aspek_penghargaan.index')); ?>"
                        class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                                   <?php echo e(request()->routeIs('aspek_penghargaan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        <i class="bi bi-star"></i>
                        <span>Aspek Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('aspek_pelanggaran.index')); ?>"
                        class="flex items-center gap-3 px-4 py-2  rounded-lg menu-link
                                   <?php echo e(request()->routeIs('aspek_pelanggaran.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        <i class="bi bi-x-octagon"></i>
                        <span>Aspek Pelanggaran</span>
                    </a>
                </li>




                <!-- Skoring Penghargaan -->
                <li>
                    <a href="<?php echo e(route('skoring_penghargaan.index')); ?>"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       <?php echo e(request()->routeIs('skoring_penghargaan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        <i class="bi bi-clipboard-check"></i>
                        <span>Skoring Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('skoring_pelanggaran.index')); ?>"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       <?php echo e(request()->routeIs('skoring_pelanggaran.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        <i class="bi bi-clipboard-x"></i>
                        <span>Skoring Pelanggaran</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('akumulasi.index')); ?>"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    <?php echo e(request()->routeIs('akumulasi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        <i class="bi bi-graph-up"></i>
                        <span>Akumulasi</span>
                    </a>
                </li>

                <?php if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3): ?>
                    <li>
                        <a href="<?php echo e(route('intervensi.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                    <?php echo e(request()->routeIs('intervensi.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                            <i class="bi bi-life-preserver"></i>
                            <span>Penanganan</span>
                        </a>
                    </li>
                <?php endif; ?>



                <?php if(auth()->user()->role == 1): ?>
                    <li>
                        <a href="<?php echo e(route('tahun_ajaran.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                             <?php echo e(request()->routeIs('tahun_ajaran.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                            <i class="bi-mortarboard"></i>
                            <span>Tahun Ajaran</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo e(route('laporan.index')); ?>"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-link
                       <?php echo e(request()->routeIs('laporan.*') ? 'active-link' : 'text-gray-600 hover:bg-gray-50'); ?>">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                <?php endif; ?>
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
<?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/layouts/wakasek/sidebar.blade.php ENDPATH**/ ?>