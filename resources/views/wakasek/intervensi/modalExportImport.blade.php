
    <div id="exportImportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Export Data Penanganan </h3>
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
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    @php
                                        $jurusanOptions = collect($kelas)->pluck('jurusan')->unique()->filter()->values();
                                    @endphp
                                    <label class="block text-sm font-medium text-gray-700">Filter Jurusan (opsional)</label>
                                    <select id="export_jurusan" class="w-full mt-1 rounded-md border-gray-200 px-3 py-2">
                                        <option value="">Semua Jurusan</option>
                                        @foreach($jurusanOptions as $jur)
                                            <option value="{{ $jur }}">{{ $jur }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Filter Kelas (opsional)</label>
                                    <select id="export_kelas" class="w-full mt-1 rounded-md border-gray-200 px-3 py-2" disabled>
                                        <option value="">Semua Kelas</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Filter Status (opsional)</label>
                                    <select id="export_status" class="w-full mt-1 rounded-md border-gray-200 px-3 py-2">
                                        <option value="">Semua Status</option>
                                        <option value="Dalam Bimbingan">Dalam Bimbingan</option>
                                        <option value="Dalam Pemantauan">Dalam Pemantauan</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <button type="button" onclick="resetFilters()" class="text-sm text-gray-600 hover:underline">Reset Filter</button>
                                <div></div>
                            </div>
                            <button
                            onclick="exportExcel()"
                             class="w-full flex items-center justify-center px-4 py-3 border border-green-300 rounded-md bg-green-50 hover:bg-green-100 text-green-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"/>
                                </svg>
                                Export ke Excel (.xlsx)
                            </button>

                                                        <button 
                                                        onclick="exportPdf()"
                                                           class="w-full flex items-center justify-center px-4 py-3 border border-red-300 rounded-md bg-red-50 hover:bg-red-100 text-red-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z"/>
                                </svg>
                                Export ke PDF (.pdf)
                            </button>

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
        function exportExcel() {
            const base = "{{ route('intervensi.export.excel') }}";
            const params = new URLSearchParams(window.location.search);
            const kelas = document.getElementById('export_kelas')?.value || '';
            const status = document.getElementById('export_status')?.value || '';
            const jurusan = document.getElementById('export_jurusan')?.value || '';
            if (kelas) params.set('kelas', kelas); else params.delete('kelas');
            if (status) params.set('status', status); else params.delete('status');
            if (jurusan) params.set('jurusan', jurusan); else params.delete('jurusan');
            params.delete('page');
            const qs = params.toString();
            window.location = base + (qs ? `?${qs}` : '');
        }

        function exportPdf() {
            const base = "{{ route('intervensi.export.pdf') }}";
            const params = new URLSearchParams(window.location.search);
            const kelas = document.getElementById('export_kelas')?.value || '';
            const status = document.getElementById('export_status')?.value || '';
            const jurusan = document.getElementById('export_jurusan')?.value || '';
            if (kelas) params.set('kelas', kelas); else params.delete('kelas');
            if (status) params.set('status', status); else params.delete('status');
            if (jurusan) params.set('jurusan', jurusan); else params.delete('jurusan');
            params.delete('page');
            const qs = params.toString();
            window.location = base + (qs ? `?${qs}` : '');
        }
        // Kelas data extracted from server-side $kelas collection
        const kelasData = @json($kelas->map(function($k){
            return ['id' => $k->id_kelas, 'nama' => $k->nama_kelas, 'jurusan' => $k->jurusan];
        }));

        function buildKelasOptions(filterJurusan = '') {
            const sel = document.getElementById('export_kelas');
            if (!sel) return;
            // clear existing options
            sel.innerHTML = '';
            const optAll = document.createElement('option');
            optAll.value = '';
            optAll.text = 'Semua Kelas';
            sel.appendChild(optAll);

            const filtered = filterJurusan ? kelasData.filter(k => k.jurusan === filterJurusan) : [];
            if (filterJurusan && filtered.length) {
                filtered.forEach(k => {
                    const o = document.createElement('option');
                    o.value = k.id;
                    o.text = k.nama;
                    sel.appendChild(o);
                });
                sel.disabled = false;
            } else {
                // when no jurusan selected, keep disabled
                sel.disabled = true;
            }
        }

        function resetFilters() {
            const jur = document.getElementById('export_jurusan');
            const stat = document.getElementById('export_status');
            const kel = document.getElementById('export_kelas');
            if (jur) jur.value = '';
            if (stat) stat.value = '';
            if (kel) {
                kel.value = '';
                buildKelasOptions('');
            }
        }

        function prepareModalFilters() {
            const jur = document.getElementById('export_jurusan')?.value || '';
            buildKelasOptions(jur);
            // if jurusan pre-selected enable kelas (already handled in buildKelasOptions)
        }

        // listen for jurusan changes to populate kelas
        document.getElementById('export_jurusan')?.addEventListener('change', function() {
            buildKelasOptions(this.value || '');
        });
        const modal = document.getElementById('exportImportModal');
        const exportImportBtn = document.getElementById('exportImportBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const exportTab = document.getElementById('exportTab');
        const importTab = document.getElementById('importTab');
        const exportContent = document.getElementById('exportContent');
        const importContent = document.getElementById('importContent');
        const processBtn = document.getElementById('processBtn');

        // Modal Controls
        exportImportBtn.onclick = () => {
            modal.classList.remove('hidden');
            prepareModalFilters();
        };
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