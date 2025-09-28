@extends('layouts.wakasek.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/laporan_skoring.css') }}">
    <style>
        /* Style untuk searchable dropdown */
        .dropdown-container {
            position: relative;
            width: 100%;
        }
        .dropdown-search {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d5db; /* border-gray-300 */
            border-radius: 0.5rem;
            outline: none;
        }
        .dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            max-height: 200px;
            overflow-y: auto;
            z-index: 50;
            display: none;
        }
        .dropdown-item {
            padding: 8px;
            cursor: pointer;
        }
        .dropdown-item:hover {
            background: #f3f4f6; /* bg-gray-100 */
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Laporan Skoring Pelanggaran/Penghargaan</h1>
                <p class="text-gray-600 mt-1">Kelola laporan skoring siswa</p>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <p class="text-sm font-semibold flex items-center gap-2">
                    <i class="bi bi-check-circle-fill text-green-600"></i>
                    {{ session('success') }}
                </p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <p class="text-sm font-semibold flex items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                    {{ session('error') }}
                </p>
            </div>
        @endif

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-xl shadow-sm border cursor-pointer hover:shadow-md transition-shadow" onclick="openFilterModal('pelanggaran')">
                <h3 class="text-lg font-semibold text-gray-900">Pelanggaran</h3>
                <p class="text-gray-600 mt-1">Lihat laporan pelanggaran siswa</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border cursor-pointer hover:shadow-md transition-shadow" onclick="openFilterModal('penghargaan')">
                <h3 class="text-lg font-semibold text-gray-900">Penghargaan</h3>
                <p class="text-gray-600 mt-1">Lihat laporan penghargaan siswa</p>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Filter Laporan</h3>
                <button onclick="closeFilterModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form id="filterForm">
                <div class="space-y-4">
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <!-- Custom Searchable Dropdown -->
                        <div class="dropdown-container">
                            <input type="text" id="kelasSearch" placeholder="Cari kelas..." class="dropdown-search">
                            <div id="kelasList" class="dropdown-list">
                                <div class="dropdown-item" data-value="">Semua Kelas</div>
                                @foreach ($kelas as $item)
                                    <div class="dropdown-item" data-value="{{ $item->id_kelas }}">
                                        {{ $item->nama_kelas }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" id="kelas" name="kelas">
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="exportToPDF()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="bi bi-file-earmark-pdf"></i> Ekspor PDF
                    </button>
                    <button type="button" onclick="exportToExcel()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="bi bi-file-earmark-excel"></i> Ekspor Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let reportType = '';

        function openFilterModal(type) {
            reportType = type;
            document.getElementById('filterModal').classList.remove('hidden');
        }

        function closeFilterModal() {
            document.getElementById('filterModal').classList.add('hidden');
            document.getElementById('filterForm').reset();
            reportType = '';
        }

        function exportToPDF() {
            const kelas = document.getElementById('kelas').value;
            const url = `{{ route('laporan.export.pdf') }}?type=${reportType}&kelas=${kelas}`;
            window.location.href = url;
        }

        function exportToExcel() {
            const kelas = document.getElementById('kelas').value;
            const url = `{{ route('laporan.export.excel') }}?type=${reportType}&kelas=${kelas}`;
            window.location.href = url;
        }

        // Searchable Dropdown Logic
        const searchInput = document.getElementById('kelasSearch');
        const list = document.getElementById('kelasList');
        const hiddenInput = document.getElementById('kelas');

        searchInput.addEventListener('focus', () => {
            list.style.display = 'block';
        });

        searchInput.addEventListener('input', () => {
            const filter = searchInput.value.toLowerCase();
            const items = list.getElementsByClassName('dropdown-item');
            Array.from(items).forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? 'block' : 'none';
            });
        });

        list.addEventListener('click', (e) => {
            if (e.target.classList.contains('dropdown-item')) {
                searchInput.value = e.target.textContent;
                hiddenInput.value = e.target.getAttribute('data-value');
                list.style.display = 'none';
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-container')) {
                list.style.display = 'none';
            }
        });
    </script>
@endpush
