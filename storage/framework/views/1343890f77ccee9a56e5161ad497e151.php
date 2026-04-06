<!-- Modal Create Kelas -->
<div id="modal-create" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
        <form action="<?php echo e(route('kelas.store')); ?>" method="POST" class="p-6 space-y-4">
            <?php echo csrf_field(); ?>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Tambah Kelas</h2>
                <button type="button" onclick="closeModal('modal-create')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="id_kelas" class="block text-sm font-medium text-gray-700 mb-1">ID Kelas</label>
                    <input type="text" id="id_kelas" name="id_kelas" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: X-AK-2, XI-RPL-1, XII-TKJ-3">
                </div>

               <div>
                        <label for="id_jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <select id="id_jurusan" name="id_jurusan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="" disabled selected>Pilih Jurusan</option>
                            <?php $__currentLoopData = $jurusanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id_jurusan); ?>"><?php echo e($item->nama_jurusan); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                <div>
                    <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas</label>
                    <input type="text" id="nama_kelas" name="nama_kelas" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: X AK 2, XI RPL 1, XII TKJ 3">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="closeModal('modal-create')"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>


<?php /**PATH D:\laragon\www\BackEnd-SikapinSebelas\resources\views/wakasek/kelas/create.blade.php ENDPATH**/ ?>