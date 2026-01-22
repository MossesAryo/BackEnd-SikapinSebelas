@extends('layouts.wakasek.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/laporan_skoring.css') }}">
    <style>
        .dropdown-container {
            position: relative;
            width: 100%;
        }

        .dropdown-search {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d5db;
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
            background: #f3f4f6;
            /* bg-gray-100 */
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
            <div class="bg-white p-6 rounded-xl shadow-sm border cursor-pointer hover:shadow-md transition-shadow"
                onclick="openFilterModal('pelanggaran')">
                <h3 class="text-lg font-semibold text-gray-900">Pelanggaran</h3>
                <p class="text-gray-600 mt-1">Lihat laporan pelanggaran siswa</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border cursor-pointer hover:shadow-md transition-shadow"
                onclick="openFilterModal('penghargaan')">
                <h3 class="text-lg font-semibold text-gray-900">Penghargaan</h3>
                <p class="text-gray-600 mt-1">Lihat laporan penghargaan siswa</p>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999]">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 relative">

            <!-- Header -->
            <div
                class="flex items-center justify-between p-6 border-b border-gray-100
                   bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="bi bi-funnel text-blue-600"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Filter Laporan</h2>
                </div>

                <button onclick="closeFilterModal()"
                    class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="filterForm" class="p-6 space-y-5">

                {{-- Kelas --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-collection text-gray-500"></i> Kelas
                    </label>

                    @if (auth()->user()->role != 4)
                        <!-- Custom Searchable Dropdown -->
                        <div class="relative">
                            <input type="text" id="kelasSearch" placeholder="Cari kelas..."
                                class="w-full rounded-xl border-2 border-gray-200 px-4 py-3
                                   focus:ring-4 focus:ring-blue-100 focus:border-blue-500">

                            <div id="kelasList"
                                class="absolute z-50 mt-2 w-full bg-white border border-gray-200
                                   rounded-xl shadow-lg max-h-48 overflow-y-auto hidden">
                                <div class="dropdown-item px-4 py-2 hover:bg-gray-100 cursor-pointer" data-value="">
                                    Semua Kelas
                                </div>
                                @foreach ($kelas as $item)
                                    <div class="dropdown-item px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                        data-value="{{ $item->id_kelas }}">
                                        {{ $item->nama_kelas }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" id="kelas" name="kelas">
                    @else
                        <!-- Walikelas -->
                        <div class="px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-bookmark-fill text-blue-600"></i>
                                <div>
                                    <p class="text-xs text-gray-600 font-medium">Kelas Walikelas</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $kelas->first()->nama_kelas ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="kelas" name="kelas" value="{{ $walikelasId }}">
                    @endif
                </div>

                {{-- Tanggal Mulai --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-calendar-event text-gray-500"></i> Tanggal Mulai
                    </label>
                    <input type="date" id="start_date" name="start_date"
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3
                           focus:ring-4 focus:ring-blue-100 focus:border-blue-500">
                </div>

                {{-- Tanggal Selesai --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-calendar-check text-gray-500"></i> Tanggal Selesai
                    </label>
                    <input type="date" id="end_date" name="end_date"
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3
                           focus:ring-4 focus:ring-blue-100 focus:border-blue-500">
                </div>

                <!-- Action -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="exportToPDF()"
                        class="px-6 py-3 rounded-xl bg-red-600 text-white hover:bg-red-700 flex items-center gap-2 shadow">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </button>

                    <button type="button" onclick="exportToExcel()"
                        class="px-6 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700 flex items-center gap-2 shadow">
                        <i class="bi bi-file-earmark-excel"></i> Excel
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
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const url =
                `{{ route('laporan.export.pdf') }}?type=${reportType}&kelas=${kelas}&start_date=${startDate}&end_date=${endDate}`;
            window.location.href = url;
        }

        function exportToExcel() {
            const kelas = document.getElementById('kelas').value;
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const url =
                `{{ route('laporan.export.excel') }}?type=${reportType}&kelas=${kelas}&start_date=${startDate}&end_date=${endDate}`;
            window.location.href = url;
        }

        // Searchable Dropdown Logic (only if elements are present)
        const searchInput = document.getElementById('kelasSearch');
        const list = document.getElementById('kelasList');
        const hiddenInput = document.getElementById('kelas');

        if (searchInput && list) {
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
                    if (hiddenInput) hiddenInput.value = e.target.getAttribute('data-value');
                    list.style.display = 'none';
                }
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown-container')) {
                    list.style.display = 'none';
                }
            });
        }
    </script>
@endpush
