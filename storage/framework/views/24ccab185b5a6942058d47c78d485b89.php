<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/wakasek/peringatan.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Data Pelanggaran</h1>
                <p class="text-gray-600 mt-1">Kelola data Pelanggaran</p>
            </div>
            <?php if(auth()->user()->role == 1): ?>
                <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Pelanggaran
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
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                <div class="relative w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input id="searchPeringatan" type="text" placeholder="Cari Surat Peringatan..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                </div>
                <div class="flex gap-2">

                    <button id="exportImportBtn"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-download"></i> Export / Import
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Pelanggaran</h3>
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
                                    Tanggal Surat Peringatan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Level Surat Peringatan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Uraian
                                </div>
                            </th>

                            <?php if(auth()->user()->role == 1): ?>
                                <th
                                    class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-gear text-gray-400"></i>
                                        Aksi
                                    </div>
                                </th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $peringatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        <?php echo e(($peringatan->firstItem() ?? 0) + $loop->iteration - 1); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-2 h-2 bg-blue-400 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <span class="text-sm font-medium text-gray-900"><?php echo e($item->tanggal_sp); ?></span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-black"><?php echo e($item->level_sp); ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-black"><?php echo e($item->alasan); ?></span>
                                </td>
                                <?php if(auth()->user()->role == 1): ?>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            <button
                                                onclick="openEditModal('<?php echo e($item->id_sp); ?>', '<?php echo e($item->tanggal_sp); ?>', '<?php echo e($item->level_sp); ?>', '<?php echo e($item->alasan); ?>')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                                title="Edit Penghargaan">
                                                <i class="bi bi-pencil-square text-sm"></i>
                                            </button>
                                            <button
                                                onclick="openDeleteModal('<?php echo e($item->id_sp); ?>', '<?php echo e($item->level_sp); ?>')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full"
                                                title="Hapus Penghargaan">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi-exclamation-triangle-fill text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data peringatan </h3>
                                    <p class="text-gray-500">Tambahkan data peringatan untuk memulai.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            <div id="pagination" class="px-6 py-4 border-t border-gray-200 bg-white">
                <?php echo $__env->make('layouts.wakasek.pagination', ['data' => $peringatan], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('wakasek.peringatan.modalExportImport', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.peringatan.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.peringatan.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.peringatan.delete', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('js/wakasek/pelanggaran.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.wakasek.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/peringatan/index.blade.php ENDPATH**/ ?>