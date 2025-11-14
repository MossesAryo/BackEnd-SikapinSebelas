
    <div id="exportImportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Export/Import Data Siswa </h3>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="mt-4">
                    <!-- Tab Navigation -->
                    <div class="flex border-b border-gray-200 mb-4">
                        <button id="exportTab" class="tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                            Export Data
                        </button>
                        <button id="importTab" class="tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                            Import Data
                        </button>
                    </div>

                    <!-- Export Tab Content -->
                    <div id="exportContent" class="tab-content space-y-4">
    <h4 class="text-sm font-medium text-gray-700">Filter Export Data:</h4>
    <form id="exportFilterForm" class="space-y-3">
        <div>
            <label class="block text-sm text-gray-600">Pilih Jurusan:</label>
            <select id="exportJurusan" name="jurusan" class="w-full mt-1 border-gray-300 rounded-md">
                <option value="">Semua Jurusan</option>
                @foreach ($jurusanList as $jurusan)
                    <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                @endforeach
            </select>
        </div>
        

        <div>
            <label class="block text-sm text-gray-600">Pilih Kelas:</label>
            <select id="exportKelas" name="kelas" class="w-full mt-1 border-gray-300 rounded-md">
                <option value="">Semua Kelas</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas->id_kelas }}" data-jurusan="{{ $kelas->jurusan }}">
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="pt-3 border-t">
        <h4 class="text-sm font-medium text-gray-700 mb-3">Pilih format export:</h4>
        
        <button
            id="exportExcelBtn"
            class="w-full flex items-center justify-center px-4 py-3 border border-green-300 rounded-md bg-green-50 hover:bg-green-100 text-green-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"/>
            </svg>
            Export ke Excel (.xlsx)
        </button>

        <button
            id="exportPdfBtn"
            class="mt-2 w-full flex items-center justify-center px-4 py-3 border border-red-300 rounded-md bg-red-50 hover:bg-red-100 text-red-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z"/>
            </svg>
            Export ke PDF (.pdf)
        </button>
    </div>
</div>


                    <!-- Import Tab Content -->
                    <div id="importContent" class="tab-content hidden">
                        <form id="importForm" 
                        action="{{ route('siswa.import') }}"
                         method="POST" enctype="multipart/form-data" class="space-y-4">
                         @csrf
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Upload file untuk import data:</h4>
                                
                                <div class="border-2 border-dashed border-gray-300 round+ed-lg p-6 text-center hover:border-gray-400 transition-colors">
                                   {{-- TAMBAHKAN NAMA="FILE" BIAR MASUK DATA NYA KOCAK--}}
                                    <input type="file" name="file" id="importFile" class="hidden" accept=".xlsx,.xls,.csv" onchange="handleFileSelect(this)">
                                    
                                    
                                    
                                    <label for="importFile" class="cursor-pointer">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium text-blue-600 hover:text-blue-500">Klik untuk upload</span>
                                                atau drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500">Excel (MAX. 10MB)</p>
                                        </div>
                                    </label>
                                </div>

                                <div id="selectedFile" class="hidden mt-3 p-3 bg-gray-50 rounded-md">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="h-8 w-8 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"/>
                                            </svg>
                                            <div class="ml-3">
                                                <p id="fileName" class="text-sm font-medium text-gray-900"></p>
                                                <p id="fileSize" class="text-xs text-gray-500"></p>
                                            </div>
                                        </div>
                                        <button onclick="removeFile()" class="text-red-400 hover:text-red-600">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3 border-t">
                                <a href="{{ asset('storage/template_siswa.xlsx') }}" download class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download Template Excel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t mt-6">
                    <button id="cancelBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" form="importForm" id="processBtn" class="hidden px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                        Proses Import
                    </button>
                </div>
            </div>
        </div>
    </div>

    

<script>
        const modal = document.getElementById('exportImportModal');
        const exportImportBtn = document.getElementById('exportImportBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const exportTab = document.getElementById('exportTab');
        const importTab = document.getElementById('importTab');
        const exportContent = document.getElementById('exportContent');
        const importContent = document.getElementById('importContent');
        const processBtn = document.getElementById('processBtn');

        // Modal Controls
        exportImportBtn.onclick = () => modal.classList.remove('hidden');
        closeModal.onclick = cancelBtn.onclick = () => {
            modal.classList.add('hidden');
            switchTab('export');
            removeFile();
        };

        // Tab Switching
        exportTab.onclick = () => switchTab('export');
        importTab.onclick = () => switchTab('import');

        function switchTab(tab) {
            if (tab === 'export') {
                exportTab.className = 'tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600';
                importTab.className = 'tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700';
                exportContent.classList.remove('hidden');
                importContent.classList.add('hidden');
                processBtn.classList.add('hidden');
            } else {
                importTab.className = 'tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600';
                exportTab.className = 'tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700';
                importContent.classList.remove('hidden');
                exportContent.classList.add('hidden');
            }
        }

        // File Handling
        function handleFileSelect(input) {
            const file = input.files[0];
            if (file) {
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = formatFileSize(file.size);
                document.getElementById('selectedFile').classList.remove('hidden');
                document.getElementById('processBtn').classList.remove('hidden');
            }
        }

        function removeFile() {
            document.getElementById('importFile').value = '';
            document.getElementById('selectedFile').classList.add('hidden');
            document.getElementById('processBtn').classList.add('hidden');
        }
        // --- FILTER KELAS BERDASARKAN JURUSAN ---
document.getElementById('exportJurusan').addEventListener('change', function () {
    const selectedJurusan = this.value;
    const kelasOptions = document.querySelectorAll('#exportKelas option');

    kelasOptions.forEach(opt => {
        if (!opt.value) return; // biarkan opsi "Semua Kelas"
        opt.style.display = (selectedJurusan === '' || opt.dataset.jurusan === selectedJurusan) ? 'block' : 'none';
    });

    document.getElementById('exportKelas').value = ''; // reset kelas tiap ganti jurusan
});

// --- EKSPORT BUTTON HANDLER ---
document.getElementById('exportExcelBtn').addEventListener('click', () => {
    const jurusan = document.getElementById('exportJurusan').value;
    const kelas = document.getElementById('exportKelas').value;
    const url = `{{ route('siswa.export.excel') }}?jurusan=${jurusan}&kelas=${kelas}`;
    window.location.href = url;
});

document.getElementById('exportPdfBtn').addEventListener('click', () => {
    const jurusan = document.getElementById('exportJurusan').value;
    const kelas = document.getElementById('exportKelas').value;
    const url = `{{ route('siswa.export.pdf') }}?jurusan=${jurusan}&kelas=${kelas}`;
    window.location.href = url;
});


        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function handleFileSelect(input) {
    const file = input.files[0];
    if (file) {
        if (file.size > 10 * 1024 * 1024) { // 10MB
            alert("Ukuran file maksimal 10MB.");
            input.value = '';
            return;
        }

        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSize').textContent = formatFileSize(file.size);
        document.getElementById('selectedFile').classList.remove('hidden');
        document.getElementById('processBtn').classList.remove('hidden');
    }
}
    </script>