<div class="bg-white border-b border-gray-200 px-6 py-3 sticky top-0 z-10 shadow-sm">
    <div class="flex items-center justify-between">
        <!-- Left: Page Title -->
        <div>
            <h1 class="text-xl font-bold" style="color: #1e3a5f;">SIJUWARA SEBELAS</h1>
            <p class="text-xs text-gray-400">Selamat datang di Sistem Jurnal Siswa Aktif</p>
        </div>

        <!-- Right: User Profile -->
        <div class="flex items-center gap-3">

            <!-- Divider -->
            <div class="w-px h-6 bg-gray-200"></div>

            <!-- Profile -->
            <a href="<?php echo e(route('profile')); ?>"
                class="flex items-center gap-3 hover:bg-gray-50 px-3 py-2 rounded-xl transition-all border border-transparent hover:border-gray-200">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm"
                    style="background: linear-gradient(135deg, #4a7ab5, #1e3a5f);">
                    <?php if(auth()->user()->role == 2): ?>
                        <?php echo e(strtoupper(substr(Auth::user()->gurubk->nama_guru_bk, 0, 1))); ?>

                    <?php elseif(auth()->user()->role == 1): ?>
                        <?php echo e(strtoupper(substr(Auth::user()->wakasek->nama_wakasek, 0, 1))); ?>

                    <?php elseif(auth()->user()->role == 4): ?>
                        <?php echo e(strtoupper(substr(Auth::user()->ketua_program->nama_ketua_program, 0, 1))); ?>

                    <?php elseif(auth()->user()->role == 3): ?>
                        <?php echo e(strtoupper(substr(Auth::user()->walikelas->nama_walikelas, 0, 1))); ?>

                    <?php endif; ?>
                </div>
                <div class="leading-tight">
                    <p class="text-sm font-semibold text-gray-800">
                        <?php if(auth()->user()->role == 2): ?>
                            <?php if(auth()->guard()->check()): ?> <?php echo e(Auth::user()->gurubk->nama_guru_bk); ?> <?php endif; ?>
                        <?php elseif(auth()->user()->role == 1): ?>
                            <?php if(auth()->guard()->check()): ?> <?php echo e(Auth::user()->wakasek->nama_wakasek); ?> <?php endif; ?>
                        <?php elseif(auth()->user()->role == 4): ?>
                            <?php if(auth()->guard()->check()): ?> <?php echo e(Auth::user()->ketua_program->nama_ketua_program); ?> <?php endif; ?>
                        <?php elseif(auth()->user()->role == 3): ?>
                            <?php if(auth()->guard()->check()): ?> <?php echo e(Auth::user()->walikelas->nama_walikelas); ?> <?php endif; ?>
                        <?php endif; ?>
                    </p>
                    <p class="text-xs text-gray-400">
                        <?php if(auth()->user()->role == 1): ?> Wakasek
                        <?php elseif(auth()->user()->role == 2): ?> Guru BK
                        <?php elseif(auth()->user()->role == 3): ?> Wali Kelas
                        <?php elseif(auth()->user()->role == 4): ?> Ketua Program
                        <?php endif; ?>
                    </p>
                </div>
                
            </a>
        </div>
    </div>
</div><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/layouts/wakasek/navbar.blade.php ENDPATH**/ ?>