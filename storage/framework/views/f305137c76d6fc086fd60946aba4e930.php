
<?php $__env->startPush('css'); ?>
    <style>
        .custom-pagination {
            display: flex;
            gap: 0.375rem;
            justify-content: flex-end;
            align-items: center;
        }

        .custom-pagination a,
        .custom-pagination span {
            background-color: #ffffff;
            border: 1px solid #3b82f6;
            color: #3b82f6;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            line-height: 1rem;
        }

        .custom-pagination a:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }

        .custom-pagination .active {
            background-color: #3b82f6;
            color: #ffffff;
            border: 1px solid #3b82f6;
        }

        .custom-pagination .disabled {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            color: #d1d5db;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
<?php $__env->stopPush(); ?>

<div id="pagination">


<?php if($data->hasPages()): ?>
    <div class="px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-600">
            Menampilkan
            <span class="font-semibold"><?php echo e($data->firstItem()); ?></span>
            sampai
            <span class="font-semibold"><?php echo e($data->lastItem()); ?></span>
            dari total
            <span class="font-semibold"><?php echo e($data->total()); ?></span>
            data
        </div>

        <div class="custom-pagination">
            
            <?php if($data->onFirstPage()): ?>
                <span class="disabled">
                    <i class="bi bi-chevron-left"></i>
                </span>
            <?php else: ?>
                <a href="<?php echo e($data->previousPageUrl()); ?>" rel="prev">
                    <i class="bi bi-chevron-left"></i>
                </a>
            <?php endif; ?>

            
            <?php
                $start = max(1, $data->currentPage() - 2);
                $end = min($data->lastPage(), $data->currentPage() + 2);
                $range = range($start, $end);
            ?>

            
            <?php if($start > 1): ?>
                <a href="<?php echo e($data->url(1)); ?>">1</a>
                <?php if($start > 2): ?>
                    <span>...</span>
                <?php endif; ?>
            <?php endif; ?>

            
            <?php $__currentLoopData = $range; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == $data->currentPage()): ?>
                    <span class="active"><?php echo e($page); ?></span>
                <?php else: ?>
                    <a href="<?php echo e($data->url($page)); ?>"><?php echo e($page); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($end < $data->lastPage()): ?>
                <?php if($end < $data->lastPage() - 1): ?>
                    <span>...</span>
                <?php endif; ?>
                <a href="<?php echo e($data->url($data->lastPage())); ?>"><?php echo e($data->lastPage()); ?></a>
            <?php endif; ?>

            
            <?php if($data->hasMorePages()): ?>
                <a href="<?php echo e($data->nextPageUrl()); ?>" rel="next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            <?php else: ?>
                <span class="disabled">
                    <i class="bi bi-chevron-right"></i>
                </span>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
</div><?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/layouts/wakasek/pagination.blade.php ENDPATH**/ ?>