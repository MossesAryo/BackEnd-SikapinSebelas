<!-- Modal catatan -->
<div id="modal-catatan"
    class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">


        <form action="{{ route('siswa.catatan', ['nis' => $siswa->nis]) }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Tambah Catatan</h2>
                <button type="button" onclick="closeModal('modal-catatan')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <div class="space-y-4">
                <div>
                    <label for="judul_catatan" class="block text-sm font-medium text-gray-700">Judul Catatan</label>
                    <input type="text" name="judul_catatan" id="judul_catatan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                        required>


                </div>
                <div>
                    <label for="isi_catatan" class="block text-sm font-medium text-gray-700">Isi Catatan</label>
                    <textarea name="isi_catatan" id="isi_catatan" rows="4"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                        required></textarea>`
                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" onclick="closeModal('modal-catatan')"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                    </div>
        </form>
    </div>
</div>
