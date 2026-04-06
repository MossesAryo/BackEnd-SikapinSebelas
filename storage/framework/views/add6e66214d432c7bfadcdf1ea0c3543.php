<?php $__env->startSection('content'); ?>
<div class="py-6">

    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <div class="relative bg-white border border-gray-200 rounded-2xl p-6 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                    <i class="bi bi-people text-blue-600 text-2xl"></i>
                </div>
                <span class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">Siswa</span>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e(number_format($totalSiswa)); ?></p>
            <p class="text-sm text-gray-400">Total siswa terdaftar</p>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-500"></div>
        </div>

        <div class="relative bg-white border border-gray-200 rounded-2xl p-6 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <i class="bi bi-award text-green-600 text-2xl"></i>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-50 px-3 py-1 rounded-lg">Prestasi</span>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e(number_format($totalApresiasi)); ?></p>
            <p class="text-sm text-gray-400">Total penghargaan dicatat</p>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-green-500"></div>
        </div>

        <div class="relative bg-white border border-gray-200 rounded-2xl p-6 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                    <i class="bi bi-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <span class="text-xs font-medium text-red-500 bg-red-50 px-3 py-1 rounded-lg">Pelanggaran</span>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e(number_format($totalPelanggaran)); ?></p>
            <p class="text-sm text-gray-400">Total pelanggaran dicatat</p>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-red-500"></div>
        </div>

        <div class="relative bg-white border border-gray-200 rounded-2xl p-6 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center">
                    <i class="bi bi-bar-chart text-indigo-600 text-2xl"></i>
                </div>
                <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg">Skor</span>
            </div>
            <p class="text-3xl font-bold text-gray-900 mb-1"><?php echo e(number_format($rataSkor)); ?></p>
            <p class="text-sm text-gray-400">Rata-rata skor siswa</p>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-500"></div>
        </div>

    </div>

    
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
        <p class="text-base font-semibold text-gray-800 mb-5">Aksi Cepat</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

            <?php if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3): ?>
            <a href="<?php echo e(route('skoring_penghargaan.index')); ?>"
                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition-all group">
                <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-award text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700 group-hover:text-green-700">Tambah</p>
                    <p class="text-xs text-gray-400 group-hover:text-green-600">Skoring Penghargaan</p>
                </div>
            </a>

            <a href="<?php echo e(route('skoring_pelanggaran.index')); ?>"
                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-red-50 hover:border-red-200 transition-all group">
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-exclamation-triangle text-red-500 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700 group-hover:text-red-600">Tambah</p>
                    <p class="text-xs text-gray-400 group-hover:text-red-500">Skoring Pelanggaran</p>
                </div>
            </a>
            <?php endif; ?>

            <a href="<?php echo e(route('siswa.index')); ?>"
                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-blue-50 hover:border-blue-200 transition-all group">
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-people text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700 group-hover:text-blue-700">Lihat</p>
                    <p class="text-xs text-gray-400 group-hover:text-blue-600">Data Siswa</p>
                </div>
            </a>

            <a href="<?php echo e(route('laporan.index')); ?>"
                class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-yellow-50 hover:border-yellow-200 transition-all group">
                <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-file-earmark-text text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700 group-hover:text-yellow-700">Export</p>
                    <p class="text-xs text-gray-400 group-hover:text-yellow-600">Laporan</p>
                </div>
            </a>

        </div>
    </div>

    
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <p class="text-base font-semibold text-gray-800">Aktivitas Skoring Terbaru</p>
            <span class="text-xs text-gray-400"><?php echo e($recentActivities->count()); ?> aktivitas</span>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex items-center gap-4 px-6 py-4 border-b border-gray-50 hover:bg-gray-50 transition-all">

                
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                    <?php echo e($log->kategori === 'Pelanggaran' ? 'bg-red-100' : 'bg-green-100'); ?>">
                    <i class="bi <?php echo e($log->kategori === 'Pelanggaran' ? 'bi-exclamation-triangle text-red-500' : 'bi-award text-green-600'); ?> text-base"></i>
                </div>

                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="text-sm font-semibold text-gray-800">
                            <?php echo e(Str::upper($log->siswa?->nama_siswa ?? $log->nis)); ?>

                        </p>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-md">
                            Kelas <?php echo e(Str::upper($log->siswa?->id_kelas?->nama_kelas ?? '—')); ?>

                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-0.5 truncate italic">"<?php echo e($log->description); ?>"</p>
                </div>

                
                <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                    <span class="text-xs font-medium px-3 py-1 rounded-lg
                        <?php echo e($log->kategori === 'Pelanggaran' ? 'bg-red-50 text-red-500' : 'bg-green-50 text-green-600'); ?>">
                        <?php echo e($log->kategori); ?>

                    </span>
                    <p class="text-xs text-gray-400"><?php echo e($log->created_at->diffForHumans()); ?></p>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="flex flex-col items-center justify-center py-16 gap-3">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center">
                    <i class="bi bi-clock-history text-gray-400 text-2xl"></i>
                </div>
                <p class="text-sm text-gray-400">Belum ada aktivitas terbaru.</p>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.wakasek.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/dashboard.blade.php ENDPATH**/ ?>