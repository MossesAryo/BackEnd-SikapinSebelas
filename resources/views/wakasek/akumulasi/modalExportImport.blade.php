 <div id="exportImportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Export Data Akumulasi</h3>
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
                    </div>

                    <!-- Export Tab Content -->
                    <div id="exportContent" class="tab-content">
                        <div class="space-y-3">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Pilih format export:</h4>
                            
                            <button
                            onclick="window.location='{{ route('akumulasi.export.excel') }}'"
                             class="w-full flex items-center justify-center px-4 py-3 border border-green-300 rounded-md bg-green-50 hover:bg-green-100 text-green-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"/>
                                </svg>
                                Export ke Excel (.xlsx)
                            </button>

                            <button 
                            onclick="window.location='{{ route('akumulasi.export.pdf') }}'"
                             class="w-full flex items-center justify-center px-4 py-3 border border-red-300 rounded-md bg-red-50 hover:bg-red-100 text-red-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z"/>
                                </svg>
                                Export ke PDF (.pdf)
                            </button>

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