<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>

        </div>

    </div>



    <!-- Notifications List -->
    <div class="bg-white rounded-xl shadow-sm border">
        <div class="divide-y divide-gray-200">

            <!-- Notification Item - Unread Apresiasi -->
            <?php if(auth()->user()->role == 1): ?>
                <?php $__currentLoopData = $notifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('statusintervensi.show', $item->id_intervensi)); ?>" class="block">
                    <div class="notification-item unread p-6 hover:bg-gray-50 transition-colors cursor-pointer relative">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="bi bi-award text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">

                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Baru
                                    </span>
                                </div>
                                <p class="text-gray-600 text-md mb-2">
                                    <?php echo e($item->siswa->nama_siswa); ?> (<?php echo e($item->nis); ?>) <strong>Telah Diintervensi
                                    </strong>
                                </p>
                                <p class="text-gray-900 font-medium mb-1">
                                    Judul Intervensi : <strong><?php echo e($item->nama_intervensi); ?></strong>
                                </p>
                                <p class="text-gray-600 text-sm mb-2">
                                    Isi : "<?php echo e($item->isi_intervensi); ?>"
                                </p>
                              <p class="text-gray-500 text-xs flex items-center gap-1">
                                        Intervensi Oleh :
                                        <?php echo e($item->guruBK->nama_guru_bk ?? 'Guru BK belum ditentukan'); ?> | Guru BK
                                    </p>
                                <p class="text-gray-500 text-xs flex items-center gap-1">
                                    <i class="bi bi-clock"></i>
                                    <?php echo e($item->created_at->diffForHumans()); ?>

                                </p>
                            </div>

                        </div>
                        <!-- Unread indicator -->
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-1 h-8 bg-blue-500 rounded-r"></div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $notifikasibk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="notification-item unread p-6 hover:bg-gray-50 transition-colors cursor-pointer relative">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="bi bi-award text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <?php echo e($item->judul_catatan); ?>

                                    </span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Baru
                                    </span>
                                </div>
                                <p class="text-gray-900 font-medium mb-1">
                                    <strong><?php echo e($item->siswa->nama_siswa); ?></strong> dari kelas
                                    <?php echo e($item->siswa->kelas->nama_kelas); ?>

                                </p>
                                <p class="text-gray-600 text-sm mb-2">
                                    "<?php echo e($item->isi_catatan); ?>"
                                </p>
                                <p class="text-gray-500 text-xs flex items-center gap-1">
                                    Catatan Dari : <?php if($item->nip_wakasek === null): ?>
                                        <?php echo e($item->walikelas->nama_walikelas); ?>

                                    <?php else: ?>
                                        <?php echo e($item->wakasek->nama_wakasek); ?> | Wakil Kepala Kesiswaan
                                    <?php endif; ?>
                                </p>
                                <p class="text-gray-500 text-xs flex items-center gap-1">
                                    <i class="bi bi-clock"></i>
                                    <?php echo e($item->created_at->diffForHumans()); ?>

                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="text-gray-400 hover:text-gray-600" title="Tandai dibaca">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                <button class="text-gray-400 hover:text-red-600" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Unread indicator -->
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-1 h-8 bg-blue-500 rounded-r"></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>








        </div>
    </div>

    <!-- Load More Button -->
    <div class="flex justify-center mt-6">
        <button class="btn btn-outline">
            <i class="bi bi-arrow-down-circle text-sm"></i>
            Muat Lebih Banyak
        </button>
    </div>

    <!-- Custom Styles -->
    <style>
        .btn {
            @apply inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-sm transition-colors;
        }

        .btn-outline {
            @apply border border-gray-300 text-gray-700 hover:bg-gray-50;
        }

        .btn-danger {
            @apply bg-red-600 text-white hover:bg-red-700;
        }

        .filter-tab.active {
            @apply bg-blue-500 text-white;
        }

        .notification-item.unread {
            @apply bg-blue-50 bg-opacity-30;
        }
    </style>

    <!-- JavaScript for Interactive Features -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter tabs functionality
            const filterTabs = document.querySelectorAll('.filter-tab');
            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    filterTabs.forEach(t => {
                        t.classList.remove('active', 'bg-blue-500', 'text-white');
                        t.classList.add('bg-gray-100', 'text-gray-600');
                    });

                    // Add active class to clicked tab
                    this.classList.add('active', 'bg-blue-500', 'text-white');
                    this.classList.remove('bg-gray-100', 'text-gray-600');
                });
            });

            // Mark as read functionality
            document.querySelectorAll('[title="Tandai dibaca"]').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const notificationItem = this.closest('.notification-item');

                    // Remove unread styles
                    notificationItem.classList.remove('unread', 'bg-blue-50', 'bg-opacity-30');

                    // Remove unread indicator
                    const indicator = notificationItem.querySelector('.absolute.left-0');
                    if (indicator) indicator.remove();

                    // Remove "Baru" badge
                    const newBadge = notificationItem.querySelector('.bg-red-100.text-red-800');
                    if (newBadge && newBadge.textContent === 'Baru') {
                        newBadge.remove();
                    }

                    // Hide the mark as read button
                    this.style.display = 'none';

                    // Change text colors to read state
                    const titleElement = notificationItem.querySelector('.text-gray-900');
                    if (titleElement) titleElement.classList.replace('text-gray-900',
                        'text-gray-700');

                    const contentElement = notificationItem.querySelector('.text-gray-600');
                    if (contentElement) contentElement.classList.replace('text-gray-600',
                        'text-gray-500');

                    const timeElement = notificationItem.querySelector('.text-gray-500');
                    if (timeElement) timeElement.classList.replace('text-gray-500',
                        'text-gray-400');
                });
            });

            // Delete functionality
            document.querySelectorAll('[title="Hapus"]').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
                        const notificationItem = this.closest('.notification-item');
                        notificationItem.style.transition = 'opacity 0.3s ease';
                        notificationItem.style.opacity = '0';
                        setTimeout(() => {
                            notificationItem.remove();
                        }, 300);
                    }
                });
            });

            // Mark all as read functionality
            document.querySelector('[data-action="mark-all-read"], .btn.btn-outline').addEventListener('click',
                function() {
                    if (confirm('Tandai semua notifikasi sebagai sudah dibaca?')) {
                        document.querySelectorAll('.notification-item.unread').forEach(item => {
                            item.classList.remove('unread', 'bg-blue-50', 'bg-opacity-30');
                            const indicator = item.querySelector('.absolute.left-0');
                            if (indicator) indicator.remove();

                            const newBadge = item.querySelector('.bg-red-100.text-red-800');
                            if (newBadge && newBadge.textContent === 'Baru') {
                                newBadge.remove();
                            }

                            const markReadBtn = item.querySelector('[title="Tandai dibaca"]');
                            if (markReadBtn) markReadBtn.style.display = 'none';
                        });
                    }
                });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.wakasek.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/notifikasi/notifikasi.blade.php ENDPATH**/ ?>