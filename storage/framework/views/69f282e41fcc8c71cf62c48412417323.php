<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/wakasek/kelas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Data Kelas</h1>
                <p class="text-gray-600 mt-1">Kelola data Kelas</p>
            </div>
             <?php if(auth()->user()->role == 1): ?>
            <button onclick="openCreateModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-plus-lg"></i>
                Tambah Kelas
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

        <!-- Search & Filter -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">


                <div class="w-full md:w-64 relative">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" name="search" id="inputSearch" placeholder="Cari Kelas..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg w-full">
                </div>
                <div class="flex gap-2">
                    <?php
                        $filterCount = collect(request()->except(['page', 'search', '_token', '_method']))
                            ->filter(function ($v) {
                                return $v !== null && $v !== '';
                            })
                            ->count();
                    ?>
                    <button onclick="openFilterModal()"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i>
                        <span class="ml-1">Filter</span>
                        <?php if($filterCount > 0): ?>
                            <span
                                class="ml-2 inline-flex items-center justify-center bg-blue-600 text-white text-xs font-semibold rounded-full w-6 h-6"><?php echo e($filterCount); ?></span>
                        <?php endif; ?>
                    </button>
                </div>
            </div>
        </div>

        

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-visible">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Kelas</h3>
                <p class="text-sm text-gray-500">Menampilkan <?php echo e(count($kelas)); ?> kelas yang tersedia</p>
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
                                    <i class="bi bi-tag text-gray-400"></i>
                                    Jurusan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-tag text-gray-400"></i>
                                    Nama Kelas
                                </div>
                            </th>
                            <?php if(auth()->user()->role == 1): ?>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-gear text-gray-400"></i>
                                        Aksi
                                    </div>
                                </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-2 h-2 bg-blue-400 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <span
                                            class="text-sm font-medium text-gray-900"><?php echo e(($kelas->firstItem() ?? 0) + $loop->iteration - 1); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900"><?php echo e($item->nama_jurusan); ?></div>
                                </td>
                                <td class="px-6 py-4">  
                                    <div class="text-sm font-semibold text-gray-900"><?php echo e($item->nama_kelas); ?></div>
                                </td>
                                <?php if(auth()->user()->role == 1): ?>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <button
                                                onclick="openEditModal('<?php echo e($item->id_kelas); ?>', '<?php echo e($item->nama_kelas); ?>', '<?php echo e($item->id_jurusan); ?>')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                                title="Edit Kelas">
                                                <i class="bi bi-pencil-square text-sm"></i>
                                            </button>
                                            <button
                                                onclick="openDeleteModal('<?php echo e($item->id_kelas); ?>', '<?php echo e($item->nama_kelas); ?>')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full"
                                                title="Hapus Kelas">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-collection text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data kelas</h3>
                                    <p class="text-gray-500">Tambahkan data kelas untuk memulai.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            <div id="pagination" class="px-6 py-4 border-t border-gray-200 bg-white">
                <?php echo $__env->make('layouts.wakasek.pagination', ['data' => $kelas], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('wakasek.kelas.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.kelas.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.kelas.delete', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.kelas.modalFilter', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        function openCreateModal() {
            const modal = document.getElementById('modal-create');
            if (!modal) return console.warn('modal-create tidak ditemukan');
            modal.classList.remove('hidden');
        }

        function openFilterModal() {
            const modal = document.getElementById('modal-filter');
            if (!modal) return console.warn('modal-filter tidak ditemukan');
            modal.classList.remove('hidden');
        }

        function openEditModal(id, nama, jurusanVal) {
            const idK = document.getElementById('edit_id_kelas');
            const nm = document.getElementById('edit_nama_kelas');
            const jur = document.getElementById('edit_jurusan');
            const form = document.getElementById('form-edit');
            const mdl = document.getElementById('modal-edit');

            console.log('Jurusan diterima:', jurusanVal, typeof jurusanVal);

            if (idK) idK.value = id;
            if (nm) nm.value = nama;
            if (jur) jur.value = jurusanVal ?? '';

            if (form) form.action = `/kelas/${id}/update`;
            if (!mdl) return console.warn('modal-edit tidak ditemukan');

            mdl.classList.remove('hidden');
        }


        function openDeleteModal(id, nama) {
            const nameEl = document.getElementById('delete-nama-kelas');
            const form = document.getElementById('form-delete');
            const mdl = document.getElementById('modal-delete');

            if (nameEl) nameEl.textContent = nama;
            if (form) form.action = `/kelas/${id}`;
            if (!mdl) return console.warn('modal-delete tidak ditemukan');
            mdl.classList.remove('hidden');
        }

        // --- CLOSERS / UX ---
        function closeAllModals() {
            document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden'));
        }

        // ESC to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAllModals();
        });

        // Klik di overlay untuk menutup (pastikan elemen overlay adalah elemen dengan id modal-*)
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) modal.classList.add('hidden');
            });
        });

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

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
                    link.addEventListener("click", function(e) {
                        e.preventDefault();

                        // Simpan page terakhir sebelum search
                        lastPageUrl = this.href;

                        fetchData(this.href);
                    });
                });
            }

            activatePaginationLinks();

            // Auto search
            input.addEventListener("keyup", function() {
                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    const query = input.value.trim();

                    if (query.length === 0) {
                        // User hapus search → kembali ke page terakhir
                        fetchData(lastPageUrl);
                        return;
                    }

                    // Search selalu mulai dari page 1
                    const url = `/kelas?search=${query}`;
                    fetchData(url);

                }, 200);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.wakasek.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/kelas/kelas.blade.php ENDPATH**/ ?>