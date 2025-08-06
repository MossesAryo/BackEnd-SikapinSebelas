@extends('layouts.app')

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
                <h1 class="text-2xl font-bold gradient-text">Data Walikelas</h1>
                <p class="text-gray-600 mt-1">Kelola data walikelas</p>
            </div>
            <button onclick="openCreateModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-plus-lg"></i>
                Tambah Walikelas
            </button>
        </div>
        
      
        @if (session('success'))
            <p class="mt-2 text-sm text-green-600 font-semibold">
                ✅ {{ session('success') }}
            </p>
        @endif
        
        @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc pl-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        
        <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                <div class="relative w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Cari Walikelas..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Walikelas</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    NIP
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Nama Walikelas
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    Kelas
                                </div>
                            </th>
                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-gear text-gray-400"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>

                    

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($walikelas as $item)
                            <tr class="hover:bg-gray-50 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <span class="text-sm font-medium text-gray-900">{{ $item->nip_walikelas }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->nama_walikelas }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-black">{{ $item->kelas->nama_kelas }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1">
                                        <button onclick="openEditModal('{{ $item->nip_walikelas }}', '{{ $item->username }}', '{{ $item->nama_walikelas}}', '{{ $item->id_kelas }}')"
                                            class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                            title="Edit Walikelas">
                                            <i class="bi bi-pencil-square text-sm"></i>
                                        </button>
                                        <button onclick="openDeleteModal('{{ $item->nip_walikelas }}', '{{ $item->nama_walikelas }}')"
                                            class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full"
                                            title="Hapus Walikelas">
                                            <i class="bi bi-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty



                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-people text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Walikelas</h3>
                                    <p class="text-gray-500">Tambahkan data walikelas untuk memulai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

   @include('wakasek.walikelas.create')
   @include('wakasek.walikelas.edit')
   @include('wakasek.walikelas.delete')

   
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
            document.getElementById('nip_walikelas').value = '';
            document.getElementById('nama_walikelas').value = '';
            document.getElementById('id_kelas').value = '';
            openModal('modal-create');
        }


        function openEditModal(nip_walikelas, username, nama_walikelas, id_kelas) {
            document.getElementById('edit_nip_walikelas').value = nip_walikelas;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_nama_walikelas').value = nama_walikelas;
            document.getElementById('edit_id_kelas').value = id_kelas;
            document.getElementById('form-edit').action = `/walikelas/${nip_walikelas}/${username}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(nip_walikelas, nama_walikelas) {
            document.getElementById('delete-nama-walikelas').innerText = nama_walikelas;
            document.getElementById('form-delete').action = `/walikelas/${nip_walikelas}`;
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