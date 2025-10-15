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
                <h1 class="text-2xl font-bold gradient-text">Data Aspek Pelanggaran</h1>
                <p class="text-gray-600 mt-1">Kelola data Aspek Pelanggaran</p>
            </div>
            @if (auth()->user()->role == 1)
                <button onclick="openCreateModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Aspek Pelanggaran
                </button>
            @endif
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
                <div id="searchAspek_pel" class="relative w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Cari Pelanggaran..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                </div>
                <div class="flex gap-2">
                    <button onclick="openfilterModal()"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>

                    <button id="exportImportBtn"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-download"></i> Export / Import
                    </button>
                </div>
            </div>
        </div>

        @include('wakasek.aspek_penilaian.aspek_pelanggaran.modalExportImport')


        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Aspek Pelanggaran</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>


                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Kategori
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Uraian
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Pelanggaran ke
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Poin
                                </div>
                            </th>
                            @if (auth()->user()->role == 1)
                                <th
                                    class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-gear text-gray-400"></i>
                                        Aksi
                                    </div>
                                </th>
                            @endif
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($aspek_penilaian as $item)
                            <tr class="hover:bg-gray-50 group">

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->kategori }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->uraian }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->pelanggaran_ke }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-900">{{ $item->indikator_poin }}</span>
                                </td>
                                @if (auth()->user()->role == 1)
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            <button
                                                onclick="openEditModal('{{ $item->id_aspekpenilaian }}','{{ $item->jenis_poin }}', '{{ $item->kategori }}', '{{ $item->uraian }}', '{{ $item->pelanggaran_ke }}', '{{ $item->indikator_poin }}')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                                title="Edit Aspek Pelanggaran">
                                                <i class="bi bi-pencil-square text-sm"></i>
                                            </button>
                                            <button onclick="openDeleteModal('{{ $item->id_aspekpenilaian }}')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full"
                                                title="Hapus Aspek Pelanggaran">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-people text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Aspek Pelanggaran</h3>
                                    <p class="text-gray-500">Tambahkan data Aspek Pelanggaran untuk memulai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                @include('layouts.wakasek.pagination', ['data' => $aspek_penilaian])
            </div>
        </div>
    </div>

    @include('wakasek.aspek_penilaian.aspek_pelanggaran.create')
    @include('wakasek.aspek_penilaian.aspek_pelanggaran.edit')
    @include('wakasek.aspek_penilaian.aspek_pelanggaran.delete')
    @include('wakasek.aspek_penilaian.aspek_pelanggaran.filter')
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

        function openfilterModal() {

            openModal('modal-filter');
        }

        function openEditModal(id, jenis, kategori, uraian, pelanggaran_ke, indikator_poin) {


            document.getElementById('edit_kategori').value = kategori;
            document.getElementById('edit_uraian').value = uraian;
            document.getElementById('edit_pelanggaran_ke').value = pelanggaran_ke;
            document.getElementById('edit_indikator_poin').value = indikator_poin;
            document.getElementById('edit_form-edit').action = `/aspek_pelanggaran/${id}/update`;
            openModal('modal-edit');

        }


        function openDeleteModal(id) {
            document.getElementById('delete-pelanggaran').innerText = id;
            document.getElementById('form-delete').action = `/aspek_pelanggaran/${id}/destroy`;
            openModal('modal-delete');
        }


        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector("#searchAspek_pel input");
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
