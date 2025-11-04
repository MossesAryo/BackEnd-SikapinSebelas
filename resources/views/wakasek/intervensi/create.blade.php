<div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4">
        <form action="{{ route('intervensi.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Tambah Penanganan</h2>
                <button type="button" onclick="closeModal('modal-create')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <div class="space-y-4">
                {{-- Pilih Siswa --}}
                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">Pilih Siswa</label>
                    <select id="nis" name="nis" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Pilih Siswa</option>
                        @foreach ($catatan as $item)
                            <option value="{{ $item->nis }}">{{ $item->siswa->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="nama_intervensi" class="block text-sm font-medium text-gray-700 mb-1">Nama
                        Penanganan</label>
                    <input type="text" id="nama_intervensi" name="nama_intervensi" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label for="isi_intervensi" class="block text-sm font-medium text-gray-700 mb-1">Isi
                        Penanganan</label>
                    <textarea id="isi_intervensi" name="isi_intervensi" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Dalam Bimbingan">Dalam Bimbingan</option>
                        <option value="Dalam Pemantauan">Dalam Pemantauan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                {{-- Tanggal Mulai Perbaikan --}}
                <div>
                    <label for="tanggal_Mulai_Perbaikan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                        Mulai Perbaikan</label>
                    <input type="date" id="tanggal_Mulai_Perbaikan" name="tanggal_Mulai_Perbaikan"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                {{-- Tanggal Selesai Perbaikan --}}
                <div>
                    <label for="tanggal_Selesai_Perbaikan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                        Selesai Perbaikan</label>
                    <input type="date" id="tanggal_Selesai_Perbaikan" name="tanggal_Selesai_Perbaikan"
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
