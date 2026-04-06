<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/wakasek/siswa.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-end gap-4">
            <!-- Header -->
            <div class="flex-1">
                <h1 class="text-2xl font-bold gradient-text">Detail Siswa</h1>
                <p class="mt-1 text-gray-600">Informasi lengkap data siswa</p>
            </div>

            <?php if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 3): ?>
                <!-- TOMBOL TAMBAH PENGHARGAAN (HIJAU) -->
                <button type="button" onclick="openCreateModalPenghargaan('<?php echo e($siswa->nis); ?>')"
                    class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors">
                    <i class="bi bi-plus"></i>
                    <span>Tambah Skoring Penghargaan</span>
                </button>

                <!-- TOMBOL TAMBAH PELANGGARAN (MERAH) - GANTI NAMA FUNGSINYA! -->
                <button type="button" onclick="openCreateModalPelanggaran('<?php echo e($siswa->nis); ?>')"
                    class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors">
                    <i class="bi bi-plus"></i>
                    <span>Tambah Skoring Pelanggaran</span>
                </button>

                <button type="button" onclick="openCreateModalPenanganan('<?php echo e($siswa->nis); ?>')"
                    class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                    <i class="bi bi-plus"></i>
                    <span>Tambah Penanganan</span>
                </button>
            <?php endif; ?>

            <?php if(auth()->user()->role == 1 || auth()->user()->role == 2): ?>
                <a href="<?php echo e(route('siswa.index')); ?>"
                    class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto
              rounded-lg bg-gray-600 text-white transition-colors hover:bg-gray-700">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            <?php endif; ?>
            <?php if(auth()->user()->role == 4): ?>
                <a href="<?php echo e(route('walikelas.siswa')); ?>"
                    class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto
              rounded-lg bg-gray-600 text-white transition-colors hover:bg-gray-700">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            <?php endif; ?>
            <?php if(auth()->user()->role == 3): ?>
                <a href="<?php echo e(route('ketua_program.siswa')); ?>"
                    class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto
              rounded-lg bg-gray-600 text-white transition-colors hover:bg-gray-700">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
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

        
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            
            <div class="xl:col-span-1 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="p-6">
                        
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center">
                                    <i class="bi bi-person-fill text-4xl text-white"></i>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <i class="bi bi-check text-white text-xs"></i>
                                </div>
                            </div>
                        </div>

                        
                        <div class="text-center">
                            <h2 class="text-xl font-bold text-gray-900 break-words">
                                <?php echo e($siswa->nama_siswa); ?>

                            </h2>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-award text-green-600"></i>
                            Penghargaan
                        </h3>


                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <?php $__empty_1 = true; $__currentLoopData = $penghargaanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <button type="button"
                                        onclick="openDeletePenghargaanModal('<?php echo e($item->siswa->nis); ?>', '<?php echo e($item->id); ?>', '<?php echo e($item->penghargaan->alasan); ?>')"
                                        class="w-full flex items-start gap-3 p-3 rounded-lg border border-green-100 bg-green-50 hover:bg-green-100 transition">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-award-fill text-green-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p class="text-sm font-semibold text-green-800">
                                                <?php echo e($item->penghargaan->level_penghargaan); ?>

                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo e($item->penghargaan->alasan); ?> -
                                                <?php echo e($item->created_at->format('d M Y')); ?>

                                            </p>
                                        </div>
                                    </button>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="text-gray-500 text-sm italic">Belum ada data penghargaan</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-exclamation-triangle text-red-600"></i>
                            Surat Peringatan
                        </h3>


                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <?php $__empty_1 = true; $__currentLoopData = $peringatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <button type="button"
                                        onclick="openDeletePeringatanModal('<?php echo e($item->siswa->nis); ?>', '<?php echo e($item->id); ?>', '<?php echo e($item->peringatan->alasan); ?>')"
                                        class="w-full flex items-start gap-3 p-3 rounded-lg border border-red-100 bg-red-50 hover:bg-red-100 transition">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-file-earmark-text-fill text-red-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p class="text-sm font-semibold text-red-800">
                                                <?php echo e($item->peringatan->level_sp); ?>

                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo e($item->peringatan->alasan); ?> -
                                                <?php echo e($item->created_at->format('d M Y')); ?>

                                            </p>
                                        </div>
                                    </button>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="text-gray-500 text-sm italic">Belum ada surat peringatan</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            
            <div class="xl:col-span-2 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Siswa</h3>
                        <?php if(auth()->user()->role == 1): ?>
                            <button
                                onclick="openEditModal('<?php echo e($siswa->nis); ?>', '<?php echo e(addslashes($siswa->nama_siswa)); ?>', '<?php echo e($siswa->id_kelas); ?>', 'show')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg flex items-center gap-2 transition-colors font-medium">
                                <i class="bi bi-pencil-square"></i>
                                Edit Profil Siswa
                            </button>
                        <?php endif; ?>

                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <?php
                                $kelasLabel = $siswa->id_kelas != 'ALUMNI' ? 'Kelas' : 'Jurusan (Alumni)';
                                $kelasValue =
                                    $siswa->id_kelas != 'ALUMNI'
                                        ? $siswa->kelas?->nama_kelas
                                        : ($siswa->jurusan?->nama_jurusan ?? 'Alumni') . ' (Alumni)';

                                $studentInfo = [
                                    ['label' => 'NIS', 'value' => $siswa->nis],
                                    ['label' => 'Nama Lengkap', 'value' => $siswa->nama_siswa],
                                    ['label' => $kelasLabel, 'value' => $kelasValue],
                                ];

                                if ($siswa->id_kelas !== 'ALUMNI') {
                                    $studentInfo[] = [
                                        'label' => 'Walikelas',
                                        'value' => $siswa->kelas?->walikelas?->nama_walikelas ?? '-',
                                    ];
                                }

                                $studentInfo[] = [
                                    'label' => 'Tahun Masuk',
                                    'value' => $siswa->tahun_masuk ?? '2023',
                                ];
                            ?>

                            <?php $__currentLoopData = $studentInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                                    <span class="text-sm font-medium text-gray-500"><?php echo e($info['label']); ?></span>
                                    <span
                                        class="text-base text-gray-900 font-medium break-words text-right"><?php echo e($info['value']); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-bar-chart text-blue-600"></i>
                            Statistik Poin
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <?php
                                $statistics = [
                                    [
                                        'type' => 'penghargaan',
                                        'icon' => 'bi-plus-circle-fill',
                                        'label' => 'Poin Penghargaan',
                                        'value' => $poinPositif ?? 0,
                                        'bgGradient' => 'from-green-50 to-emerald-50',
                                        'borderColor' => 'border-green-200',
                                        'iconBg' => 'bg-green-100',
                                        'iconColor' => 'text-green-600',
                                        'labelColor' => 'text-green-600',
                                        'valueColor' => 'text-green-700',
                                    ],
                                    [
                                        'type' => 'pelanggaran',
                                        'icon' => 'bi-dash-circle-fill',
                                        'label' => 'Poin Pelanggaran',
                                        'value' => $poinNegatif ?? 0,
                                        'bgGradient' => 'from-red-50 to-rose-50',
                                        'borderColor' => 'border-red-200',
                                        'iconBg' => 'bg-red-100',
                                        'iconColor' => 'text-red-600',
                                        'labelColor' => 'text-red-600',
                                        'valueColor' => 'text-red-700',
                                    ],
                                    [
                                        'type' => 'akumulasi',
                                        'icon' => 'bi-calculator-fill',
                                        'label' => 'Poin Total',
                                        'value' => $poinTotal ?? 0,
                                        'bgGradient' => 'from-blue-50 to-indigo-50',
                                        'borderColor' => 'border-blue-200',
                                        'iconBg' => 'bg-blue-100',
                                        'iconColor' => 'text-blue-600',
                                        'labelColor' => 'text-blue-600',
                                        'valueColor' => 'text-blue-700',
                                    ],
                                ];
                            ?>

                            <?php $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="stat-card bg-gradient-to-r <?php echo e($stat['bgGradient']); ?> p-4 rounded-lg border <?php echo e($stat['borderColor']); ?> cursor-pointer"
                                    data-type="<?php echo e($stat['type']); ?>">
                                    <div class="text-center">
                                        <div
                                            class="w-12 h-12 <?php echo e($stat['iconBg']); ?> rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="bi <?php echo e($stat['icon']); ?> <?php echo e($stat['iconColor']); ?> text-xl"></i>
                                        </div>
                                        <p class="<?php echo e($stat['labelColor']); ?> text-sm font-medium mb-1"><?php echo e($stat['label']); ?>

                                        </p>
                                        <p class="text-2xl font-bold <?php echo e($stat['valueColor']); ?>"><?php echo e($stat['value']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>



                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-clipboard-check text-orange-600"></i>
                            Penanganan Siswa
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <?php if(isset($intervensiList) && $intervensiList->count() > 0): ?>
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Penanganan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kesepakatan Waktu Perbaikan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status Penanganan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $intervensiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $int): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-gray-50" style="cursor:pointer"
                                            onclick="window.location='<?php echo e(route('intervensi.show', $int->id_intervensi)); ?>'">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    <p class="font-medium"><?php echo e($int->nama_intervensi); ?></p>
                                                    <p class="text-gray-500"><?php echo e(Str::limit($int->isi_intervensi, 80)); ?>

                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    <p class="font-medium">
                                                        <?php if($int->tanggal_Mulai_Perbaikan && $int->tanggal_Selesai_Perbaikan): ?>
                                                            <?php echo e(\Carbon\Carbon::parse($int->tanggal_Mulai_Perbaikan)->format('d M Y')); ?>

                                                            -
                                                            <?php echo e(\Carbon\Carbon::parse($int->tanggal_Selesai_Perbaikan)->format('d M Y')); ?>

                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </p>
                                                    <p class="text-gray-500"><?php echo e($int->created_at->format('d M Y')); ?></p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($int->status == 'Membaik' ? 'bg-green-100 text-green-800' : ($int->status == 'Selesai' ? 'bg-green-100 text-green-800' : ($int->status == 'Dalam Proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))); ?>"><?php echo e($int->status); ?></span>
                                                    <p class="text-gray-500 mt-1">
                                                        <?php echo e(Str::limit($int->isi_intervensi, 120)); ?>

                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="py-8 text-center text-gray-500">
                                <i class="bi bi-calendar-x text-gray-400 text-4xl mb-3"></i>
                                <p class="text-sm">Belum ada penanganan</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-clock-history text-gray-700"></i>
                            Aktivitas Terakhir
                        </h3>

                    </div>
                    <div class="p-6">
                        <?php if($activities->count() > 0): ?>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $isViolation = $activity->kategori === 'Pelanggaran';
                                        $point = $isViolation ? "-{$activity->point}" : "+{$activity->point}";
                                        $cardClass = $isViolation
                                            ? 'bg-red-50 border-red-200 hover:bg-red-100'
                                            : 'bg-green-50 border-green-200 hover:bg-green-100';
                                        $titleClass = $isViolation ? 'text-red-800' : 'text-green-800';
                                        $textClass = $isViolation ? 'text-red-700' : 'text-green-700';
                                        $pointClass = $isViolation ? 'text-red-600' : 'text-green-600';
                                    ?>

                                    <div
                                        class="flex items-center justify-between p-4 rounded-lg border transition <?php echo e($cardClass); ?>">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-base font-bold break-words <?php echo e($titleClass); ?> mb-1">
                                                <?php echo e($activity->activity); ?>

                                            </h4>
                                            <p class="text-xs font-semibold <?php echo e($textClass); ?> mb-1">
                                                <?php echo e($activity->kategori); ?>

                                            </p>
                                            <p class="text-sm break-words <?php echo e($textClass); ?> mb-2">
                                                <?php echo e($activity->description); ?>

                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo e($activity->created_at->format('d M Y')); ?>

                                            </p>
                                        </div>
                                        <div class="ml-4">
                                            <span class="text-lg font-bold <?php echo e($pointClass); ?>">
                                                <?php echo e($point); ?>

                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <i class="bi bi-calendar-x text-gray-400 text-4xl mb-3"></i>
                                <p class="text-gray-500 text-sm">Belum ada aktivitas tercatat</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(auth()->user()->role == 1): ?>
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">

                
                <?php if($siswa->status === 'aktif'): ?>
                    <button onclick="openNonaktifModal('<?php echo e($siswa->nis); ?>', '<?php echo e($siswa->nama_siswa); ?>')"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                        <i class="bi bi-person-dash"></i>
                        Nonaktifkan Siswa
                    </button>
                <?php endif; ?>

                
                <button onclick="openDeleteModal('<?php echo e($siswa->nis); ?>', '<?php echo e($siswa->nama_siswa); ?>')"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="bi bi-trash"></i>
                    Hapus Siswa
                </button>

            </div>
        <?php endif; ?>
    </div>

    

    <?php echo $__env->make('wakasek.siswa.create-penanganan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.siswa.create-penghargaan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.siswa.create-pelanggaran', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('wakasek.siswa.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.siswa.delete', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.siswa.penghargaan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('wakasek.siswa.peringatan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div id="nonaktifModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">

        <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                <h3 class="text-lg font-semibold">Nonaktifkan Siswa</h3>
            </div>

            <div class="px-6 py-5 text-sm text-gray-700">
                <p>
                    Siswa <b id="nonaktifNama"></b> akan:
                </p>
                <ul class="list-disc pl-5 mt-2 text-gray-600">
                    <li>Status diubah menjadi <b>Nonaktif</b></li>
                    <li>Dipindahkan ke kelas <b>NONAKTIF</b></li>
                    <li>Tidak ikut kenaikan kelas</li>
                </ul>
                
            </div>

            <div class="px-6 py-4 border-t flex justify-end gap-2">
                <button onclick="closeNonaktifModal()" class="px-4 py-2 rounded-lg border hover:bg-gray-50">
                    Batal
                </button>

                <form method="POST" id="nonaktifForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 flex items-center gap-2">
                        <i class="bi bi-check-circle"></i>
                        Ya, Nonaktifkan
                    </button>
                </form>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('js/wakasek/siswa.js')); ?>"></script>
    <script>
        // Statistik card click handlers
        document.addEventListener('DOMContentLoaded', function() {
            const nis = '<?php echo e($siswa->nis); ?>';
            const penghargaanUrl = '<?php echo e(route('skoring_penghargaan.index')); ?>';
            const pelanggaranUrl = '<?php echo e(route('skoring_pelanggaran.index')); ?>';
            const akumulasiUrl = '<?php echo e(route('akumulasi.index')); ?>';

            document.querySelectorAll('.stat-card').forEach(card => {
                card.addEventListener('click', () => {
                    const type = card.dataset.type;
                    if (type === 'penghargaan') {
                        window.location.href = `${penghargaanUrl}?search=${nis}`;
                    } else if (type === 'pelanggaran') {
                        window.location.href = `${pelanggaranUrl}?search=${nis}`;
                    } else if (type === 'akumulasi') {
                        window.location.href = `${akumulasiUrl}?search=${nis}`;
                    }
                });
            });
        });

        // Nonaktifkan Siswa Modal Functions
        function openNonaktifModal(nis, nama) {
            document.getElementById('nonaktifNama').innerText = nama;
            document.getElementById('nonaktifForm').action =
                "<?php echo e(route('siswa.nonaktif', ':nis')); ?>".replace(':nis', nis);

            document.getElementById('nonaktifModal').classList.remove('hidden');
        }

        function closeNonaktifModal() {
            document.getElementById('nonaktifModal').classList.add('hidden');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.wakasek.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/siswa/show.blade.php ENDPATH**/ ?>