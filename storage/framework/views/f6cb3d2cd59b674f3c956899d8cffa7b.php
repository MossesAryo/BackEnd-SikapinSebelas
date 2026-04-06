<?php $__env->startPush('css'); ?>
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .modal-overlay {
            z-index: 9999 !important;
        }

        body.modal-open {
            overflow: hidden;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Skoring Pelanggaran</h1>
                <p class="text-gray-600 mt-1">Kelola Skoring Pelanggaran</p>
            </div>
             <?php if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3): ?>
            <button onclick="openCreateModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-plus-lg"></i>
                Tambah Skoring Pelanggaran
            </button>
            <?php endif; ?>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <p class="text-sm font-semibold flex items-center gap-2">
                    <i class="bi bi-check-circle-fill text-green-600"></i>
                    <?php echo e(session('success')); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <p class="text-sm font-semibold flex items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                    <?php echo e(session('error')); ?>

                </p>
            </div>
        <?php endif; ?>

        <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <form method="GET" action="<?php echo e(route('skoring_pelanggaran.index')); ?>">
                <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                    <div id="searchPelanggaran" class="relative w-full md:w-64">
                        <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                        <input id="inputSearch" type="text" placeholder="Cari Nama Siswa..."
                            class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                    </div>
                        <div class="flex gap-2">
                            <?php
                                $filterCount = collect(request()->except(['page','search','_token','_method']))->filter(function($v){ return $v !== null && $v !== ''; })->count();
                            ?>
                            <button type="button" onclick="openFilterModal()"
                                class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                                <i class="bi bi-funnel"></i>
                                <span class="ml-1">Filter</span>
                                <?php if($filterCount > 0): ?>
                                    <span class="ml-2 inline-flex items-center justify-center bg-blue-600 text-white text-xs font-semibold rounded-full w-6 h-6"><?php echo e($filterCount); ?></span>
                                <?php endif; ?>
                            </button>
                            <?php if(auth()->user()->role == 1): ?>
                        <a href="<?php echo e(route('laporan.index')); ?>"
                            class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                            <i class="bi bi-download"></i> Export
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

            </form>

                <!-- Active Filters Display -->
                
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-visible">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Skoring Pelanggaran</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    No
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    NIS
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    Nama Siswa
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Tanggal Pelanggaran
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Jenis Pelanggaran
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Skor
                                </div>
                            </th>
                            <?php if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 4): ?>
                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-gear text-gray-400"></i>
                                    Aksi
                                </div>
                            </th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($loop->iteration + ($penilaian->currentPage() - 1) * $penilaian->perPage()); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($item->siswa->nis ?? '-'); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($item->siswa->nama_siswa ?? '-'); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($item->created_at); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($item->aspek_penilaian->uraian ?? '-'); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($item->aspek_penilaian->indikator_poin ?? 0); ?></td>
                                <?php if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 4): ?>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <button
                                            onclick="openDeleteModalPelanggaran('<?php echo e($item->id_penilaian); ?>', '<?php echo e($item->siswa->nama_siswa); ?>')"
                                            type="button" class="text-red-600 hover:text-red-800 action-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-people text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Skoring Pelanggaran</h3>
                                    <p class="text-gray-500">Tambahkan data Pelanggaran untuk memulai.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION -->
            <div id="pagination" class="px-6 py-4 border-t border-gray-200 bg-white">
                <?php echo $__env->make('layouts.wakasek.pagination', ['data' => $penilaian], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>

<!-- Filter Modal — Tema Biru Elegan (Sama seperti Skoring Penghargaan) -->
<div id="modal-filter" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 relative overflow-visible">
        <!-- Header dengan Gradient Biru -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-funnel-fill text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Filter Data Pelanggaran</h3>
            </div>
            <button onclick="closeModal('modal-filter')"
                class="text-gray-400 hover:text-gray-600 hover:bg-gray-200 rounded-full p-2 transition">
                <i class="bi bi-x-lg text-lg"></i>
            </button>
        </div>

        <!-- Form Body -->
        <form method="GET" action="<?php echo e(route('skoring_pelanggaran.index')); ?>">
            <div class="p-6 space-y-6">
        <?php if(auth()->user()->role == 1): ?>
                <!-- Filter Kelas -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap-fill text-blue-600"></i>
                        Kelas
                    </label>
                    <select name="kelas" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">
                        <option value="">Semua Kelas</option>
                        <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id_kelas); ?>" <?php echo e(request('kelas') == $k->id_kelas ? 'selected' : ''); ?>>
                                <?php echo e($k->nama_kelas); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
        <?php endif; ?>
                <!-- Filter Jenis Pelanggaran -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill text-blue-600"></i>
                        Jenis Pelanggaran
                    </label>
                    <select name="jenis_pelanggaran" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">
                        <option value="">Semua Jenis</option>
                        <?php $__currentLoopData = $aspekPel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($aspek->id_aspekpenilaian); ?>" <?php echo e(request('jenis_pelanggaran') == $aspek->id_aspekpenilaian ? 'selected' : ''); ?>>
                                <?php echo e($aspek->uraian); ?> (<?php echo e($aspek->indikator_poin); ?> poin)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Filter Tanggal -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <i class="bi bi-calendar-event text-blue-600"></i>
                            Tanggal Mulai
                        </label>
                        <input type="date" name="tanggal_mulai" value="<?php echo e(request('tanggal_mulai')); ?>"
                            class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <i class="bi bi-calendar-check text-blue-600"></i>
                            Tanggal Akhir
                        </label>
                        <input type="date" name="tanggal_akhir" value="<?php echo e(request('tanggal_akhir')); ?>"
                            class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Footer Tombol -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 px-6 py-5 border-t bg-gray-50">
                <a href="<?php echo e(route('skoring_pelanggaran.index')); ?>"
                    class="order-last sm:order-none px-6 py-3 rounded-xl border-2 border-gray-300 text-gray-700 hover:bg-gray-100 transition flex items-center justify-center gap-2">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700 shadow-lg transition flex items-center justify-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>
</div>

    <?php echo $__env->make('wakasek.skoring.pelanggaran.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.skoring.pelanggaran.delete', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            openModal('modal-create');
        }

        function openFilterModal() {
            openModal('modal-filter');
        }

        function openDeleteModalPelanggaran(id_pelanggaran, nama) {
            document.getElementById('delete-pelanggaran').innerText = nama;
            document.getElementById('form-delete-pelanggaran').action = `/skoring_pelanggaran/${id_pelanggaran}/destroy`;
            openModal('modal-delete-pelanggaran');
        }

        // Allow ESC/backdrop close only for non-destructive modals
        const overlayClosableModals = ['modal-create', 'modal-filter'];

        document.addEventListener('click', function(event) {
            overlayClosableModals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                overlayClosableModals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });

          // Search functionality
    document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("inputSearch");
    const tableBody = document.getElementById("tableBody");
    const pagination = document.getElementById("pagination");

    let debounceTimer = null;

    // Simpan halaman terakhir sebelum search
    let lastPageUrl = window.location.href;

    function fetchData(url) {
        fetch(url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");

                tableBody.innerHTML = doc.querySelector("#tableBody").innerHTML;
                pagination.innerHTML = doc.querySelector("#pagination").innerHTML;

                activatePaginationLinks();
            })
            .catch(err => console.error("ERR:", err));
    }

    function activatePaginationLinks() {
        const links = document.querySelectorAll("#pagination a");

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();

                // Simpan page terakhir sebelum search
                lastPageUrl = this.href;

                fetchData(this.href);
            });
        });
    }

    activatePaginationLinks();

    // Auto search
    input.addEventListener("keyup", function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            const query = input.value.trim();

            if (query.length === 0) {
                // User hapus search → kembali ke page terakhir
                fetchData(lastPageUrl);
                return;
            }

            // Search selalu mulai dari page 1
            const url = `/skoring_pelanggaran?search=${query}`;
            fetchData(url);

        }, 200);
    });
});
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.wakasek.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/skoring/pelanggaran/index.blade.php ENDPATH**/ ?>