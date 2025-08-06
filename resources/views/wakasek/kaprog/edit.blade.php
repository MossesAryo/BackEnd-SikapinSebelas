<!-- Modal Edit -->
    <div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <form id="form-edit" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Edit Ketua Program</h2>
                    <button type="button" onclick="closeModal('modal-edit')"
                        class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="edit_nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" id="edit_nip" name="nip_kaprog" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50">
                    </div>
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Ketua Program</label>
                        <input type="text" id="edit_nama" name="nama_ketua_program" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" name="username" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                       <label for="edit_id_jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                            <select class="form-select" id="edit_id_jurusan" name="id_jurusan">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id_jurusan }}" {{ isset($ketua_program->id_jurusan) && $j->id_jurusan == $ketua_program->id_jurusan ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>

                            
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" onclick="closeModal('modal-edit')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>