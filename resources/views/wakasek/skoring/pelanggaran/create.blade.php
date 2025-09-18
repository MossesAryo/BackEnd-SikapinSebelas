<div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
        <form action="{{ route('skoring_pelanggaran.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="flex justify-between items-center">

                <h2 class="text-xl font-bold text-gray-700">Tambah Pelanggaran</h2>

                <button type="button" onclick="closeModal('modal-create')"
                    class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <div class="space-y-4">
                
                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">Pilih Siswa</label>
                    <select id="nis" name="nis" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Pilih Siswa</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->nis }}">{{ $item->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="id_aspekpenilaian" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                        Pelanggaran</label>
                    <select id="id_aspekpenilaian" name="id_aspekpenilaian" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        onchange="updateSkor(this)">
                        <option value="" disabled selected>Pilih Jenis Pelanggaran</option>
                        @foreach ($aspekPel as $item)
                            <option value="{{ $item->id_aspekpenilaian }}" data-skor="{{ $item->indikator_poin }}">
                                {{ $item->indikator_poin }} - {{ $item->uraian }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="skor" class="block text-sm font-medium text-gray-700 mb-1">Skor</label>
                    <input type="text" id="skor" name="skor"
                        value="{{ $aspekPel->first()->indikator_poin ?? '' }}" readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
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

<script>
    function updateSkor(select) {
        let skor = select.options[select.selectedIndex].dataset.skor;
        document.getElementById('skor').value = skor;
    }
</script>
