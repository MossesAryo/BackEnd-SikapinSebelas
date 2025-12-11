<!-- Modal Edit -->
<div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 my-8 overflow-visible">
        <form id="form-edit" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <!-- Hidden input untuk tahu dari mana modal dibuka -->
            <input type="hidden" name="redirect_to" id="redirect_to" value="index">

            <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Edit Siswa</h2>
                <button type="button" onclick="closeModal('modal-edit')"
                    class="text-gray-400 hover:text-gray-600 text-3xl leading-none">&times;</button>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">NIS</label>
                    <input type="text" id="edit_nis" name="nis" required readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Siswa</label>
                    <input type="text" id="edit_nama_siswa" name="nama_siswa" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
                    <select id="edit_id_kelas" name="id_kelas" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled>Pilih Kelas</option>
                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-5 border-t">
                <button type="button" onclick="closeModal('modal-edit')"
                    class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-medium transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>