<!-- Modal Create -->
    <div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <form action="{{ route('siswa.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Tambah Siswa</h2>
                    <button type="button" onclick="closeModal('modal-create')"
                        class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                        <input type="text" id="nis" name="nis" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="nama_siswa" class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <input type="text" id="nama_siswa" name="nama_siswa" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="id_kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select id="id_kelas" name="id_kelas" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($kelasList as $item)
                                <option value="{{ $item->id_kelas }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
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