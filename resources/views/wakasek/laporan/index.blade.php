@extends('layouts.wakasek.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/laporan_skoring.css') }}">
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
                        <select id="kelas" name="kelas" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id_kelas }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Jurusan</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
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
            const jurusan = document.getElementById('jurusan').value;
            
            const url = `{{ route('laporan.export.pdf') }}?type=${reportType}&kelas=${kelas}&jurusan=${jurusan}`;
            window.location.href = url;
        }

        function exportToExcel() {
            const kelas = document.getElementById('kelas').value;
            const jurusan = document.getElementById('jurusan').value;
            
            const url = `{{ route('laporan.export.excel') }}?type=${reportType}&kelas=${kelas}&jurusan=${jurusan}`;
            window.location.href = url;
        }
    </script>
@endpush