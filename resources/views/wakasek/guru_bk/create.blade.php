    <!-- Modal Create Guru BK -->
    <div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <form action="{{ route('gurubk.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Tambah Guru BK</h2>
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>
                <div class="space-y-2">
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" id="nip" name="nip_bk"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none "
                            required>
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none"
                            required>
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama_guru_bk"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none "
                            required>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
