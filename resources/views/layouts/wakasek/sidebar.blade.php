<!-- Sidebar -->
<style>
    .dropdown-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .dropdown-content.show {
        max-height: 200px;
        transition: max-height 0.3s ease-in;
    }

    .dropdown-arrow {
        transition: transform 0.3s ease;
    }

    .dropdown-arrow.rotate {
        transform: rotate(180deg);
    }

    .active-link {
        color: #2563eb;
        background-color: #eff6ff;
    }
    .menu-link.active-link:hover {
    background-color: #dbeafe; /* Tailwind blue-100 */
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
                <li>
                    <a href="{{ route('wakasek.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-blue-600 bg-blue-50 rounded-lg menu-link" data-link="dashboard">
                        <i class="bi bi-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- User Dropdown -->
                <li>
                    <button onclick="toggleDropdown('userDropdown')" class="flex items-center justify-between w-full px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-person-gear"></i>
                            <span>User</span>
                        </div>
                        <i class="bi bi-chevron-down dropdown-arrow text-sm" id="userArrow"></i>
                    </button>
                    <div id="userDropdown" class="dropdown-content ml-4 mt-1">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('walikelas.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="wali-kelas">
                                    <i class="bi bi-person-check"></i>
                                    <span>Wali Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('gurubk.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="guru-bk">
                                    <i class="bi bi-person-heart"></i>
                                    <span>Guru BK</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kaprog.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="kaprog">
                                    <i class="bi bi-person-badge"></i>
                                    <span>Kaprog</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                   <!-- FAQ Dropdown -->
                <li>
                    <button onclick="toggleDropdown('faqDropdown')" class="flex items-center justify-between w-full px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-person-gear"></i>
                            <span>FAQ</span>
                        </div>
                        <i class="bi bi-chevron-down dropdown-arrow text-sm" id="faqArrow"></i>
                    </button>
                    <div id="faqDropdown" class="dropdown-content ml-4 mt-1">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('penghargaan.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="wali-kelas">
                                    <i class="bi bi-person-check"></i>
                                    <span>Penghargaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('peringatan.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="guru-bk">
                                    <i class="bi bi-person-heart"></i>
                                    <span>Pelanggaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspek_penghargaan.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="guru-bk">
                                    <i class="bi bi-person-heart"></i>
                                    <span>Aspek Penghargaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aspek_pelanggaran.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="guru-bk">
                                    <i class="bi bi-person-heart"></i>
                                    <span>Aspek Pelanggaran</span>
                                </a>
                            </li>
                        </div>




                         
                <li>
                    <a href="{{ route('skoring_penghargaan.index') }}" class="flex items-center gap-3 px-3 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="siswa">
                        <i class="bi bi-people"></i>
                        <span>Skoring Penghargaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('skoring_pelanggaran.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="siswa">
                        <i class="bi bi-people"></i>
                        <span>Skoring Pelanggaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="siswa">
                        <i class="bi bi-people"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('akumulasi.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="siswa">
                        <i class="bi bi-bar-chart"></i>
                        <span>Akumulasi</span>
                    </a>
                </li>
              
                <li>
                    <a href="{{ route('kelas') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="kelas">
                        <i class="bi bi-door-open"></i>
                        <span>Kelas</span>
                    </a>
                </li>
               
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="laporan">
                        <i class="bi bi-bar-chart"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="laporan-jam-malam">
                        <i class="bi bi-moon"></i>
                        <span>Laporan Jam Malam</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg menu-link" data-link="aktivitas">
                        <i class="bi bi-activity"></i>
                        <span>Aktivitas</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const arrow = document.getElementById('userArrow');

        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
            arrow.classList.remove('rotate');
        } else {
            dropdown.classList.add('show');
            arrow.classList.add('rotate');
        }
    }


    document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const userButton = event.target.closest('button');
    const insideDropdown = event.target.closest('#userDropdown');

    if (!userButton && !insideDropdown) {
        dropdown.classList.remove('show');
        document.getElementById('userArrow').classList.remove('rotate');
    }
});


function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    const arrow = document.getElementById('faqArrow');

    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        arrow.classList.remove('rotate');
    } else {
        dropdown.classList.add('show');
        arrow.classList.add('rotate');
    }
}


document.addEventListener('click', function(event) {
const dropdown = document.getElementById('faqDropdown');
const userButton = event.target.closest('button');
const insideDropdown = event.target.closest('#faqDropdown');

if (!userButton && !insideDropdown) {
    dropdown.classList.remove('show');
    document.getElementById('faqArrow').classList.remove('rotate');
}
});
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function(e) {


            // Remove active from all
            document.querySelectorAll('.menu-link').forEach(item => {
                item.classList.remove('active-link', 'text-blue-600', 'bg-blue-50');
                item.classList.add('text-gray-600');
            });

            // Add active to clicked
            this.classList.add('active-link', 'text-blue-600', 'bg-blue-50');
            this.classList.remove('text-gray-600');
        });
    });
</script>
