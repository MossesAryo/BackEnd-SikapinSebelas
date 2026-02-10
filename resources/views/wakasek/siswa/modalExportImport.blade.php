<div id="exportImportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Export/Import Data Siswa</h3>
                <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4">
                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200 mb-4">
                    <button type="button" id="exportTab" class="tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                        Export Data
                    </button>
                    <button type="button" id="importTab" class="tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                        Import Data
                    </button>
                </div>

                <!-- Export Tab Content -->
                <div id="exportContent" class="tab-content">
                    <div class="space-y-4">
                        <!-- Jurusan Selection -->
                        <div class="w-full">
                            <label for="exportJurusan" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Jurusan
                            </label>
                            <div class="relative">
                                <select 
                                    id="exportJurusan" 
                                    name="jurusan" 
                                    class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg shadow-sm appearance-none cursor-pointer
                                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                           hover:border-gray-400 transition-colors duration-200
                                           text-gray-700 text-sm"
                                >
                                    <option value="" class="text-gray-500">Semua Jurusan</option>
                                    @foreach ($jurusanList as $jurusan)
                                        <option value="{{ $jurusan }}" class="text-gray-900">{{ $jurusan }}</option>
                                    @endforeach
                                </select>
                                <!-- Custom dropdown arrow -->
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kelas Selection -->
                        <div class="w-full">
                            <label for="exportKelas" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Kelas
                            </label>
                            <div class="relative">
                                <select 
                                    id="exportKelas" 
                                    name="kelas" 
                                    class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg shadow-sm appearance-none cursor-pointer
                                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                           hover:border-gray-400 transition-colors duration-200
                                           text-gray-700 text-sm disabled:bg-gray-100 disabled:cursor-not-allowed"
                                >
                                    <option value="" class="text-gray-500">Semua Kelas</option>
                                    @foreach ($kelasList as $kelas)
                                        <option 
                                            value="{{ $kelas->id_kelas }}" 
                                            data-jurusan="{{ $kelas->jurusan }}"
                                            class="text-gray-900"
                                        >
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Custom dropdown arrow -->
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Export Buttons -->
                        <div class="pt-3 border-t">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Pilih format export:</h4>
                            
                            <button
                                type="button"
                                id="exportExcelBtn"
                                class="w-full flex items-center justify-center px-4 py-3 border border-green-300 rounded-md bg-green-50 hover:bg-green-100 text-green-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"/>
                                </svg>
                                Export ke Excel (.xlsx)
                            </button>

                            <button
                                type="button"
                                id="exportPdfBtn"
                                class="mt-2 w-full flex items-center justify-center px-4 py-3 border border-red-300 rounded-md bg-red-50 hover:bg-red-100 text-red-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z"/>
                                </svg>
                                Export ke PDF (.pdf)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Import Tab Content -->
                <div id="importContent" class="tab-content hidden">
                    <form id="importForm" 
                        action="{{ route('siswa.import') }}"
                        method="POST" 
                        enctype="multipart/form-data" 
                        class="space-y-4">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Upload file untuk import data:</h4>
                                
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                    <input type="file" name="file" id="importFile" class="hidden" accept=".xlsx,.xls,.csv">
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
                                        <button type="button" id="removeFileBtn" class="text-red-400 hover:text-red-600">
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
                    </form>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t mt-6">
                <button type="button" id="cancelBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
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
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get all elements
        const modal = document.getElementById('exportImportModal');
        const exportImportBtn = document.getElementById('exportImportBtn');
        const closeModalBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const exportTab = document.getElementById('exportTab');
        const importTab = document.getElementById('importTab');
        const exportContent = document.getElementById('exportContent');
        const importContent = document.getElementById('importContent');
        const processBtn = document.getElementById('processBtn');
        const importFileInput = document.getElementById('importFile');
        const removeFileBtn = document.getElementById('removeFileBtn');

        // Modal open/close functions
        function openModal() {
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeModal() {
            if (modal) {
                modal.classList.add('hidden');
                switchTab('export');
                removeFile();
            }
        }

        // Event listeners for modal controls
        if (exportImportBtn) {
            exportImportBtn.addEventListener('click', openModal);
        }

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', closeModal);
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeModal);
        }

        // Close modal when clicking outside
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        // Tab Switching
        if (exportTab) {
            exportTab.addEventListener('click', () => switchTab('export'));
        }

        if (importTab) {
            importTab.addEventListener('click', () => switchTab('import'));
        }

        function switchTab(tab) {
            if (tab === 'export') {
                if (exportTab) {
                    exportTab.className = 'tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600';
                }
                if (importTab) {
                    importTab.className = 'tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700';
                }
                if (exportContent) {
                    exportContent.classList.remove('hidden');
                }
                if (importContent) {
                    importContent.classList.add('hidden');
                }
                if (processBtn) {
                    processBtn.classList.add('hidden');
                }
            } else {
                if (importTab) {
                    importTab.className = 'tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600';
                }
                if (exportTab) {
                    exportTab.className = 'tab-button px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700';
                }
                if (importContent) {
                    importContent.classList.remove('hidden');
                }
                if (exportContent) {
                    exportContent.classList.add('hidden');
                }
            }
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // File Handling
        function handleFileSelect(input) {
            const file = input.files[0];
            if (file) {
                if (file.size > 10 * 1024 * 1024) { // 10MB
                    alert("Ukuran file maksimal 10MB.");
                    input.value = '';
                    return;
                }

                const fileNameEl = document.getElementById('fileName');
                const fileSizeEl = document.getElementById('fileSize');
                const selectedFileEl = document.getElementById('selectedFile');
                const processBtnEl = document.getElementById('processBtn');

                if (fileNameEl) fileNameEl.textContent = file.name;
                if (fileSizeEl) fileSizeEl.textContent = formatFileSize(file.size);
                if (selectedFileEl) selectedFileEl.classList.remove('hidden');
                if (processBtnEl) processBtnEl.classList.remove('hidden');
            }
        }

        function removeFile() {
            const importFile = document.getElementById('importFile');
            const selectedFile = document.getElementById('selectedFile');
            const processBtn = document.getElementById('processBtn');
            
            if (importFile) importFile.value = '';
            if (selectedFile) selectedFile.classList.add('hidden');
            if (processBtn) processBtn.classList.add('hidden');
        }

        // File input change event
        if (importFileInput) {
            importFileInput.addEventListener('change', function() {
                handleFileSelect(this);
            });
        }

        // Remove file button
        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', removeFile);
        }

        // Filter Kelas berdasarkan Jurusan
        const exportJurusanSelect = document.getElementById('exportJurusan');
        if (exportJurusanSelect) {
            exportJurusanSelect.addEventListener('change', function () {
                const selectedJurusan = this.value;
                const kelasOptions = document.querySelectorAll('#exportKelas option');

                kelasOptions.forEach(opt => {
                    if (!opt.value) return; // biarkan opsi "Semua Kelas"
                    opt.style.display = (selectedJurusan === '' || opt.dataset.jurusan === selectedJurusan) ? 'block' : 'none';
                });

                const kelasSelect = document.getElementById('exportKelas');
                if (kelasSelect) {
                    kelasSelect.value = ''; // reset kelas tiap ganti jurusan
                }
            });
        }

        // Export Button Handlers
        const exportExcelBtn = document.getElementById('exportExcelBtn');
        if (exportExcelBtn) {
            exportExcelBtn.addEventListener('click', () => {
                const jurusan = document.getElementById('exportJurusan')?.value || '';
                const kelas = document.getElementById('exportKelas')?.value || '';
                const url = `{{ route('siswa.export.excel') }}?jurusan=${jurusan}&kelas=${kelas}`;
                window.location.href = url;
            });
        }

        const exportPdfBtn = document.getElementById('exportPdfBtn');
        if (exportPdfBtn) {
            exportPdfBtn.addEventListener('click', () => {
                const jurusan = document.getElementById('exportJurusan')?.value || '';
                const kelas = document.getElementById('exportKelas')?.value || '';
                const url = `{{ route('siswa.export.pdf') }}?jurusan=${jurusan}&kelas=${kelas}`;
                window.location.href = url;
            });
        }
    });
</script>