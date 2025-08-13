<!-- Modal Create -->
<div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
        <form action="{{ route('aspekpenilaian.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Tambah Aspek Penilaian</h2>
                <button type="button" onclick="closeModal('modal-create')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <div class="space-y-4">
                <div>
                    <label for="id_aspekpenilaian" class="block text-sm font-medium text-gray-700 mb-1">KODE</label>
                    <input type="text" id="id_aspekpenilaian" name="id_aspekpenilaian" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label for="jenis_poin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Poin</label>
                    <select name="jenis_poin" id="jenis_poin" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        <option value="" disabled selected>Pilih Jenis Poin</option>
                        <option value="Pelanggaran">Pelanggaran</option>
                        <option value="Apresiasi">Apresiasi</option>
                    </select>
                </div>
                <div>
                    <label for="indikator_poin" class="block text-sm font-medium text-gray-700 mb-1">Indikator
                        Poin</label>
                    <input type="text" id="indikator_poin" name="indikator_poin" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label for="uraian" class="block text-sm font-medium text-gray-700 mb-1">Uraian</label>
                    <input type="text" id="uraian" name="uraian" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
