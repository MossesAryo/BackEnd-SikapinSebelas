<div id="modal-create-penanganan" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4">
        
        <form id="form-create-penanganan" 
              action="{{ route('show.create.penanganan', ['nis' => $siswa->nis]) }}" 
              method="POST" 
              class="p-6 space-y-4">

            @csrf

            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Tambah Penanganan</h2>
                <button type="button" onclick="closeModal('modal-create-penanganan')" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <div class="space-y-4">

                {{-- Nama & NIS (read-only, konsisten seperti modal lain) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>

                    <!-- Tampil nama -->
                    <div class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-800">
                        {{ $siswa->nama_siswa }}
                    </div>

                    <!-- NIS dikirim ke server -->
                    <input type="hidden" id="nis" name="nis" value="{{ $siswa->nis }}">
                </div>

                <div>
                    <label for="nama_intervensi" class="block text-sm font-medium text-gray-700 mb-1">Nama Penanganan</label>
                    <input type="text" id="nama_intervensi" name="nama_intervensi" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="isi_intervensi" class="block text-sm font-medium text-gray-700 mb-1">Isi Penanganan</label>
                    <textarea id="isi_intervensi" name="isi_intervensi" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="Dalam Bimbingan">Dalam Bimbingan</option>
                        <option value="Dalam Pemantauan">Dalam Pemantauan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div>
                    <label for="tanggal_Mulai_Perbaikan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Perbaikan</label>
                    <input type="date" id="tanggal_Mulai_Perbaikan" name="tanggal_Mulai_Perbaikan" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="tanggal_Selesai_Perbaikan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai Perbaikan</label>
                    <input type="date" id="tanggal_Selesai_Perbaikan" name="tanggal_Selesai_Perbaikan" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="closeModal('modal-create-penanganan')" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>

                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Versi final: tidak ubah desain, tidak merusak logic lain
    function openCreateModalPenanganan(nis) {
        document.getElementById('nis').value = nis;
        openModal('modal-create-penanganan');
    }
</script>
