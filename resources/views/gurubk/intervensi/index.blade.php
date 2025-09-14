    @extends('layouts.gurubk.app')

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/gurubk/siswa.css') }}">
    @endpush

    @section('content')
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold gradient-text">Data Intervensi</h1>
                    <p class="text-gray-600 mt-1">Kelola Intervensi</p>
                </div>
                <button onclick="openCreateModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Intervensi
                </button>
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
                    <div id="searchSiswa" class="relative w-full md:w-64">
                        <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                        <input type="text" placeholder="Cari Intervensi..."
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


            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Intervensi</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        Nama Siswa
                                    </div>
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        Kelas
                                    </div>
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        Tanggal Mulai Perbaikan
                                    </div>
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        tanggal Selesai Perbaikan
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        Nama Intervensi
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        Status
                                    </div>
                                </th>

                                <th
                                    class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-gear text-gray-400"></i>
                                        Aksi
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($intervensi as $item)
                                <tr class="hover:bg-gray-50 group">

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->siswa->nama_siswa }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $item->siswa->kelas->nama_kelas }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $item->tanggal_Mulai_Perbaikan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $item->tanggal_Selesai_Perbaikan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->nama_intervensi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->status }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            
                                            <a href="{{ route('intervensi.show', ['id_intervensi' => $item->id_intervensi]) }}"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-yellow-600 hover:text-yellow-800 hover:bg-orange-50 rounded-full"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye text-sm"></i>
                                            </a>

                                            {{-- <a href="{{ route('intervensi.edit', $item->id) }}"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                                title="Edit Data">
                                                <i class="bi bi-pencil text-sm"></i>
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div
                                            class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="bi bi-people text-3xl text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data intervensi</h3>
                                        <p class="text-gray-500">Tambahkan data intervensi untuk memulai.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>


                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex justify-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('gurubk.intervensi.create')
    @endsection

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
            document.getElementById('nis').value = '';
            document.getElementById('nama_intervensi').value = '';
            document.getElementById('status').value = '';
            document.getElementById('tanggal_Mulai_Perbaikan').value = '';
            document.getElementById('tanggal_Selesai_Perbaikan').value = '';
            openModal('modal-create');
        }

        function openEditModal(nis, nama_siswa, id_kelas) {
            document.getElementById('edit_nis').value = nis;
            document.getElementById('edit_nama_siswa').value = nama_siswa;
            document.getElementById('edit_id_kelas').value = id_kelas;
            document.getElementById('form-edit').action = `/siswa/${nis}/update`;
            openModal('modal-edit');
        }

        function openDeleteModal(nis, nama_siswa) {
            document.getElementById('delete-nama-siswa').innerText = nama_siswa;
            document.getElementById('form-delete').action = `/siswa/${nis}`;
            openModal('modal-delete');
        }

        function openDeletePenghargaanModal(nis, id, nama_penghargaan) {
            document.getElementById('delete-nama-penghargaan').innerText = nama_penghargaan;
            document.getElementById('form-delete-penghargaan').action = `/siswa/${nis}/penghargaan/${id}`;
            openModal('modal-delete-penghargaan');
        }

        function openDeletePeringatanModal(nis, id, nama_peringatan) {
            document.getElementById('delete-nama-peringatan').innerText = nama_peringatan;
            document.getElementById('form-delete-peringatan').action = `/siswa/${nis}/peringatan/${id}`;
            openModal('modal-delete-peringatan');
        }

        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter', 'modal-penghargaan', 'modal-peringatan',
                'modal-delete-penghargaan', 'modal-delete-peringatan', 'modal-catatan'
            ].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter', 'modal-penghargaan',
                    'modal-peringatan', 'modal-delete-penghargaan', 'modal-delete-peringatan', 'modal-catatan'
                ].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
    </script>
