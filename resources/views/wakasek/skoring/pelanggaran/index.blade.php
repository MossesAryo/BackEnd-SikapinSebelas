@extends('layouts.wakasek.app')

@push('css')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .modal-overlay {
            z-index: 9999 !important;
        }

        body.modal-open {
            overflow: hidden;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Skoring Pelanggaran</h1>
                <p class="text-gray-600 mt-1">Kelola Skoring Pelanggaran</p>
            </div>
            <button onclick="openCreateModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-plus-lg"></i>
                Tambah Skoring Pelanggaran
            </button>
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

        <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                <div id="searchPelanggaran" class="relative w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Cari Ketua Program..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('laporan.index') }}"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-download"></i> Export
                    </a>

                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Skoring Pelanggaran</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    No
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    NIS
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    Nama Siswa
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Tanggal Pelanggaran
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Jenis Pelanggaran
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Skor
                                </div>
                            </th>
                            {{-- <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Penanganan Pelanggaran
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                  Kesepakatan waktu perbaikan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                Perubahan setelah Penanganan
                                </div>
                            </th> --}}
                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-gear text-gray-400"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($penilaian as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->siswa->nis ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->created_at }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->aspek_penilaian->uraian ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $item->aspek_penilaian->indikator_poin ?? 0 }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <button
                                            onclick="openDeleteModalPelanggaran('{{ $item->id_penilaian }}', '{{ $item->siswa->nama_siswa }}')"
                                            class="text-red-600 hover:text-red-800 action-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-people text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Skoring Pelanggaran
                                    </h3>
                                    <p class="text-gray-500">Tambahkan data Pelanggaran untuk memulai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                @include('layouts.wakasek.pagination', ['data' => $penilaian])
            </div>
        </div>
    </div>
    @include('wakasek.skoring.pelanggaran.create')

    @include('wakasek.skoring.pelanggaran.delete')
@endsection

@push('js')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {

            openModal('modal-create');
        }

        function openEditModal(id_penghargaan, tanggal_penghargaan, level_penghargaan, alasan) {
            document.getElementById('edit_id_penghargaan').value = id_penghargaan;
            document.getElementById('edit_tanggal_penghargaan').value = tanggal_penghargaan;
            document.getElementById('edit_level_penghargaan').value = level_penghargaan;
            document.getElementById('edit_alasan').value = alasan;
            document.getElementById('form-edit').action = `/penghargaan/${id_penghargaan}/update`;
            openModal('modal-edit');
        }


        function openDeleteModalPelanggaran(id_pelanggaran, nama) {
            document.getElementById('delete-pelanggaran').innerText = nama;
            document.getElementById('form-delete-pelanggaran').action = `/skoring_pelanggaran/${id_pelanggaran}/destroy`;
            openModal('modal-delete-pelanggaran');
        }

        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete-pelanggaran'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete-pelanggaran'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector("#searchPelanggaran input");
            const tableRows = document.querySelectorAll("tbody tr");

            searchInput.addEventListener("keyup", function() {
                const searchText = this.value.toLowerCase();

                tableRows.forEach(row => {

                    if (row.querySelector("td[colspan]")) {
                        row.style.display = searchText === "" ? "" : "none";
                        return;
                    }

                    const rowText = row.innerText.toLowerCase();
                    if (rowText.includes(searchText)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>
@endpush
