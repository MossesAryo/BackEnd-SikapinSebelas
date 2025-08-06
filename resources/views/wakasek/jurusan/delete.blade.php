 <!-- Modal Delete Jurusan -->
    <div id="modal-delete"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-md">
            <form id="form-delete" method="POST" class="p-8 space-y-6">
                @csrf
                @method('DELETE')
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Hapus</h2>
                    <p class="text-gray-600 mb-1">Apakah Anda yakin ingin menghapus jurusan</p>
                    <p class="font-semibold text-red-600 text-lg" id="delete-nama-jurusan"></p>
                    <p class="text-sm text-gray-500 mt-3">Tindakan ini tidak dapat dibatalkan</p>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('modal-delete').classList.add('hidden')"
                        class="flex-1 btn-secondary py-3 rounded-xl font-medium">
                        <i class="bi bi-arrow-left mr-2"></i>Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-medium transition-all duration-300 hover:transform hover:-translate-y-0.5">
                        <i class="bi bi-trash mr-2"></i>Hapus Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>