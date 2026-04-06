    <!DOCTYPE html>

    <?php $__env->startPush('css'); ?>
        <style>
            .modal-open {
                overflow: hidden !important;
            }

            [z-[999999]] {
                z-index: 999999 !important;
            }
        </style>
    <?php $__env->stopPush(); ?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sikapin - Sistem Skoring</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
            rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <link rel="stylesheet" href="<?php echo e(asset('css/wakasek/app.css')); ?>">
        <?php echo $__env->yieldPushContent('css'); ?>
    </head>

    <body class="bg-gray-50">
        <!-- Dashboard Layout -->
        <div class="flex">
            <?php echo $__env->make('layouts.wakasek.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Top Navigation -->
                <?php echo $__env->make('layouts.wakasek.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <!-- Dashboard Content -->
                <div class="p-6">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>


        <?php echo $__env->yieldPushContent('js'); ?>
    </body>

    </html>
<?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/layouts/wakasek/app.blade.php ENDPATH**/ ?>