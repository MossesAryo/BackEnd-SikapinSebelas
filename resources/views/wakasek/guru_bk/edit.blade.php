    <!-- Modal Edit Guru BK -->
    <div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <form id="form-edit" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Edit Guru BK</h2>
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700 text-xl ">&times;</button>
                </div>
                <div class="space-y-2">
                    <div>
                        <label for="edit_nip_bk" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" id="edit_nip_bk" name="nip_bk"
                            class=" mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none">
                    </div>
                    <div>
                        <label for="edit_username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="edit_username" name="username"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none"
                            required>
                    </div>
                    <div>
                        <label for="edit_nama_guru_bk" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="edit_nama_guru_bk" name="nama_guru_bk"
                            class=" mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none"
                            required>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
