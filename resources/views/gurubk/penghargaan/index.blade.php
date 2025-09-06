@extends('layouts.gurubk.app')

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
                <h1 class="text-2xl font-bold gradient-text">Data Penghargaan</h1>
                <p class="text-gray-600 mt-1">Kelola data Penghargaan</p>
            </div>
            
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <p class="mt-2 text-sm text-green-600 font-semibold">
                ✅ {{ session('success') }}
            </p>
        @endif

        @if (session('error'))
            <p class="mt-2 text-sm text-red-600 font-semibold">
                ❌ {{ session('error') }}
            </p>
        @endif

        <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                <div class="relative w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Cari Ketua Program..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                </div>
                <div class="flex gap-2">

                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button id="exportImportBtn"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
            </div>
        </div>

        @include('gurubk.penghargaan.modalExportImport')


          <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Penghargaan</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                     KODE
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                     Tanggal Surat Penghargaan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Level Penghargaan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Alasan
                                </div>
                            </th>
                        
                            
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($penghargaan as $item)
                            <tr class="hover:bg-gray-50 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-2 h-2 bg-blue-400 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $item->id_penghargaan }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->tanggal_penghargaan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-black">{{ $item->level_penghargaan }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-black">{{ $item->alasan }}</span>
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1">
                                        <button
                                            onclick="openEditModal('{{ $item->id_penghargaan }}', '{{ $item->tanggal_penghargaan }}', '{{ $item->level_penghargaan }}', '{{ $item->alasan }}')"
                                            class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                            title="Edit Penghargaan">
                                            <i class="bi bi-pencil-square text-sm"></i>
                                        </button>
                                        <button
                                            onclick="openDeleteModal('{{ $item->id_penghargaan }}', '{{ $item->level_penghargaan }}')"
                                            class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full"
                                            title="Hapus Penghargaan">
                                            <i class="bi bi-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-people text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Penghargaan</h3>
                                    <p class="text-gray-500">Tambahkan data Penghargaan untuk memulai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('gurubk.penghargaan.create')
    @include('gurubk.penghargaan.edit')
    @include('gurubk.penghargaan.delete')
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
            document.getElementById('id_penghargaan').value = '';
            document.getElementById('tanggal_penghargaan').value = '';
            document.getElementById('level_penghargaan').value = '';
            document.getElementById('alasan').value = '';
            openModal('modal-create');
        }

        function openEditModal(id_penghargaan, tanggal_penghargaan, level_penghargaan, alasan) {
            document.getElementById('edit_id_penghargaan').value = id_penghargaan;
            document.getElementById('edit_tanggal_penghargaan').value = tanggal_penghargaan;
            document.getElementById('edit_level_penghargaan').value = level_penghargaan;
            document.getElementById('edit_alasan').value = alasan;
            document.getElementById('form-edit').action = `/penghargaanbk/${id_penghargaan}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(id_penghargaan, nama) {
            document.getElementById('delete-penghargaan').innerText = nama;
            document.getElementById('form-delete').action = `/penghargaanbk/${id_penghargaan}`;
            openModal('modal-delete');
        }

        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
    </script>
@endpush
