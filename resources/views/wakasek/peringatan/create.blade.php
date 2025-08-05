<!-- Modal Create -->
<div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
        <form action="{{ route('peringatan.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Tambah Peringatan</h2>
                <button type="button" onclick="closeModal('modal-create')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="id_sp" class="block text-sm font-medium text-gray-700 mb-1">ID Peringatan</label>
                    <input type="number" id="id_sp" name="id_sp" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="tanggal_sp" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                        Peringatan</label>
                    <input type="date" id="tanggal_sp" name="tanggal_sp" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="level_sp" class="block text-sm font-medium text-gray-700 mb-1">Level Peringatan</label>
                    <select id="level_sp" name="level_sp" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="SP1">SP1</option>
                        <option value="SP2">SP2</option>
                        <option value="SP3">SP3</option>
                    </select>
                </div>

                <div>
                    <label for="alasan" class="block text-sm font-medium text-gray-700 mb-1">Alasan</label>
                    <textarea id="alasan" name="alasan" rows="3" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
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
