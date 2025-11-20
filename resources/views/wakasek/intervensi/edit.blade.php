<div id="modal-edit"
    class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4 
                max-h-[90vh] overflow-y-auto"> <!-- Tambahan ini -->
        <form id="form-edit" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div class="flex justify-between items-center sticky top-0 bg-white z-10 pb-2">
                <h2 class="text-xl font-bold text-gray-700">Edit Penanganan</h2>
                <button type="button" onclick="closeModal('modal-edit')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <div class="space-y-4">
                {{-- Pilih Siswa --}}
                <div>
                    <label for="nis_edit" class="block text-sm font-medium text-gray-700 mb-1">Pilih Siswa</label>

                    <!-- SELECT hanya untuk tampilan (tidak bisa diubah) -->
                    <select id="nis_edit" disabled
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed">
                        <option value="">Memuat...</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->nis }}">{{ $item->nama_siswa }}</option>
                        @endforeach
                    </select>

                    <!-- Hidden input agar nilai tetap terkirim -->
                    <input type="hidden" id="nis_hidden_edit" name="nis">
                </div>


                <div>
                    <label for="nama_intervensi_edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Penanganan</label>
                    <input type="text" id="nama_intervensi_edit" name="nama_intervensi" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="isi_intervensi_edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Isi Penanganan</label>
                    <textarea id="isi_intervensi_edit" name="isi_intervensi" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <div>
                    <label for="status_edit" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status_edit" name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        onchange="togglePerubahanFieldEdit()">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Dalam Bimbingan">Dalam Bimbingan</option>
                        <option value="Dalam Pemantauan">Dalam Pemantauan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                {{-- Field Perubahan Setelah Intervensi --}}
                <div id="perubahan-field-edit" class="hidden">
                    <label for="perubahan_setelah_intervensi_edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Perubahan Setelah Penanganan
                    </label>
                    <textarea id="perubahan_setelah_intervensi_edit" name="perubahan_setelah_intervensi" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <div>
                    <label for="tanggal_Mulai_Perbaikan_edit"
                        class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Perbaikan</label>
                    <input type="date" id="tanggal_Mulai_Perbaikan_edit" name="tanggal_Mulai_Perbaikan"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="tanggal_Selesai_Perbaikan_edit"
                        class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai Perbaikan</label>
                    <input type="date" id="tanggal_Selesai_Perbaikan_edit" name="tanggal_Selesai_Perbaikan"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 sticky bottom-0 bg-white z-10">
                <button type="button" onclick="closeModal('modal-edit')"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>


<script>
    function togglePerubahanField() {
        const status = document.getElementById('status').value;
        const perubahanField = document.getElementById('perubahan-field');
        const perubahanTextarea = document.getElementById('perubahan_setelah_intervensi');
        

        if (status === 'Selesai') {
            perubahanField.classList.remove('hidden');
            perubahanTextarea.setAttribute('required', 'required'); // wajib diisi
        } else {
            perubahanField.classList.add('hidden');
            perubahanTextarea.removeAttribute('required'); // tidak wajib
            perubahanTextarea.value = ''; // reset isi kalau ganti status
        }
    }
</script>
