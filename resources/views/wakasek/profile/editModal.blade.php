<!-- Modal Edit Profile -->
<div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 my-8 overflow-visible">

        <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Edit Profil</h2>

                <button type="button" onclick="closeModal('modal-edit')"
                    class="text-gray-400 hover:text-gray-600 text-3xl leading-none">
                    &times;
                </button>
            </div>

            <!-- Form -->
            <div class="space-y-5">

                <!-- Nama Wakasek -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Wakasek
                    </label>

                    <input
                        type="text"
                        name="nama_wakasek"
                        value="{{ auth()->user()->wakasek->nama_wakasek ?? '' }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- NIP Wakasek -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        NIP Wakasek
                    </label>

                    <input
                        type="text"
                        name="nip_wakasek"
                        value="{{ auth()->user()->wakasek->nip_wakasek ?? '' }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ auth()->user()->email }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-5 border-t">

                <button
                    type="button"
                    onclick="closeModal('modal-edit')"
                    class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-medium transition">
                    Simpan Perubahan
                </button>

            </div>
        </form>
    </div>
</div>