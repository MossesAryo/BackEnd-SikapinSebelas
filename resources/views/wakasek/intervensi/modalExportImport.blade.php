{{-- Export Data Penanganan Modal --}}
<div id="exportImportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Export Data Penanganan</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="mt-4">
                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200 mb-4">
                    <button id="exportTab"
                        class="tab-button px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                        Export Data
                    </button>
                </div>

                <!-- Export Tab Content -->
                <div id="exportContent" class="tab-content">
                    <div class="space-y-4">

                        @php
                            $jurusanOptions = collect($kelas)->pluck('jurusan')->unique()->filter()->values();
                            $userRole = auth()->user()->role ?? null;
                        @endphp

                        @if ($userRole == 4)
                            {{-- Role 4: Wali Kelas — show read-only info card --}}
                            <div class="px-4 py-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-bookmark-fill text-blue-600"></i>
                                    <div>
                                        <p class="text-xs text-gray-600 font-medium">Kelas Wali</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $kelas->first()->nama_kelas ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">Jurusan: {{ $selectedJurusan ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="export_jurusan" value="{{ $selectedJurusan }}">
                            <input type="hidden" id="export_kelas" value="{{ $selectedKelas }}">
                        @else
                            {{-- Jurusan Filter --}}
                            <div class="w-full">
                                <label for="export_jurusan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Filter Jurusan (opsional)
                                </label>
                                <div class="relative">
                                    <select id="export_jurusan" name="jurusan"
                                        class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg shadow-sm appearance-none cursor-pointer
                                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                               hover:border-gray-400 transition-colors duration-200 text-gray-700 text-sm
                                               @if ($userRole == 3 && $selectedJurusan) opacity-60 cursor-not-allowed @endif"
                                        @if ($userRole == 3 && $selectedJurusan) disabled @endif>
                                        <option value="">Semua Jurusan</option>
                                        @foreach ($jurusanOptions as $jurusan)
                                            <option value="{{ $jurusan->id_jurusan }}"
                                                {{ request('jurusan') == $jurusan->id_jurusan ? 'selected' : '' }}>
                                                {{ $jurusan->id_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Kelas Filter --}}
                            <div class="w-full">
                                <label for="export_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                    Filter Kelas (opsional)
                                </label>
                                <div class="relative">
                                    <select id="export_kelas" name="kelas"
                                        class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg shadow-sm appearance-none cursor-pointer
                                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                               hover:border-gray-400 transition-colors duration-200 text-gray-700 text-sm
                                               disabled:bg-gray-100 disabled:cursor-not-allowed"
                                        disabled>
                                        <option value="">Semua Kelas</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id_kelas }}"
                                                data-jurusan="{{ $k->id_jurusan }}"
                                                {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Status Filter --}}
                        <div class="w-full">
                            <label for="export_status" class="block text-sm font-medium text-gray-700 mb-2">
                                Filter Status (opsional)
                            </label>
                            <div class="relative">
                                <select id="export_status" name="status"
                                    class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg shadow-sm appearance-none cursor-pointer
                                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                           hover:border-gray-400 transition-colors duration-200 text-gray-700 text-sm">
                                    <option value="">Semua Status</option>
                                     <option value="Binaan Khusus">Binaan Khusus</option>
                        <option value="Dalam Binaan">Dalam Binaan</option>
                        <option value="Selesai">Selesai</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Export Buttons --}}
                        <div class="pt-3 border-t">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Pilih format export:</h4>

                            <button id="exportExcelBtn" type="button"
                                class="w-full flex items-center justify-center px-4 py-3 border border-green-300 rounded-md bg-green-50 hover:bg-green-100 text-green-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z" />
                                </svg>
                                Export ke Excel (.xlsx)
                            </button>

                            <button id="exportPdfBtn" type="button"
                                class="mt-2 w-full flex items-center justify-center px-4 py-3 border border-red-300 rounded-md bg-red-50 hover:bg-red-100 text-red-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z" />
                                </svg>
                                Export ke PDF (.pdf)
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t mt-6">
                <button id="cancelBtn" type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const exportImportModal = document.getElementById('exportImportModal');
    const exportImportBtn = document.getElementById('exportImportBtn');
    const closeModalBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');

    function openModal() {
        exportImportModal.classList.remove('hidden');
        prepareModalFilters();
    }

    function closeModal() {
        exportImportModal.classList.add('hidden');
    }

    exportImportBtn.onclick = openModal;
    closeModalBtn.onclick = closeModal;
    cancelBtn.onclick = closeModal;

    exportImportModal.addEventListener('click', function(e) {
        if (e.target === exportImportModal) closeModal();
    });

    function prepareModalFilters() {
        const jurEl = document.getElementById('export_jurusan');
        if (jurEl && jurEl.tagName === 'SELECT') {
            filterKelasByJurusan(jurEl.value);
        }
    }

    function filterKelasByJurusan(selectedJurusan) {
        const kelasEl = document.getElementById('export_kelas');
        if (!kelasEl || kelasEl.tagName !== 'SELECT') return;

        const options = kelasEl.querySelectorAll('option');
        options.forEach(opt => {
            if (!opt.value) return;
            opt.style.display = (!selectedJurusan || opt.dataset.jurusan === selectedJurusan) ? 'block' : 'none';
        });

        kelasEl.value = '';
        kelasEl.disabled = !selectedJurusan;
    }

    document.getElementById('export_jurusan')?.addEventListener('change', function() {
        filterKelasByJurusan(this.value);
    });

    function buildExportParams() {
        const params = new URLSearchParams(window.location.search);
        const kelas = document.getElementById('export_kelas')?.value || '';
        const status = document.getElementById('export_status')?.value || '';
        const jurusan = document.getElementById('export_jurusan')?.value || '';
        kelas   ? params.set('kelas', kelas)     : params.delete('kelas');
        status  ? params.set('status', status)   : params.delete('status');
        jurusan ? params.set('jurusan', jurusan) : params.delete('jurusan');
        params.delete('page');
        return params.toString();
    }

    document.getElementById('exportExcelBtn').addEventListener('click', () => {
        const qs = buildExportParams();
        window.location.href = `{{ route('intervensi.export.excel') }}` + (qs ? `?${qs}` : '');
    });

    document.getElementById('exportPdfBtn').addEventListener('click', () => {
        const qs = buildExportParams();
        window.location.href = `{{ route('intervensi.export.pdf') }}` + (qs ? `?${qs}` : '');
    });
</script>