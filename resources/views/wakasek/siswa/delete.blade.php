
<div id="modal-delete" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-[9999]" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 relative">
        <form id="form-delete" method="POST" class="p-6 space-y-6">
            @csrf
            @method('DELETE')

            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Hapus Siswa</h2>
                <button type="button" onclick="closeModal('modal-delete')"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
            </div>

            <div class="text-center py-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-exclamation-triangle text-3xl text-red-600"></i>
                </div>
                <p class="text-gray-700 text-lg">
                    Yakin ingin menghapus siswa <br>
                    <span id="delete-nama-siswa" class="font-bold text-red-600"></span>?
                </p>
                <p class="text-sm text-gray-500 mt-2">Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeModal('modal-delete')"
                    class="flex-1 px-4 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition font-medium">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>