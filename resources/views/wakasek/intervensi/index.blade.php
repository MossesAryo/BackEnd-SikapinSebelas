    @extends('layouts.wakasek.app')

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/gurubk/siswa.css') }}">
    @endpush

    @section('content')
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold gradient-text">Data Penanganan</h1>
                    <p class="text-gray-600 mt-1">Kelola Penanganan</p>
                </div>
                <button onclick="openCreateModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Penanganan
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
                        <input type="text" placeholder="Cari Penanganan..."
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
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Penanganan</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-gray-400"></i>
                                        No
                                    </div>
                                </th>
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
                                        Nama Penanganan
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
                                        <div class="text-sm font-semibold text-gray-900">{{ $loop->iteration }}
                                        </div>
                                    </td>
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

                                            <button
                                                onclick="openEditModal('{{ $item->id_intervensi }}', '{{ $item->nis }}', '{{ $item->nama_intervensi }}','{{ $item->isi_intervensi }}','{{ $item->status }}', '{{ $item->tanggal_Mulai_Perbaikan }}', '{{ $item->tanggal_Selesai_Perbaikan }}','{{ $item->perubahan_setelah_intervensi ?? '' }}')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full">
                                                <i class="bi bi-pencil-square text-sm"></i>
                                            </button>
                                            <button
                                                onclick="openDeleteModal('{{ $item->id_intervensi }}', '{{ $item->nis }}', '{{ $item->nama_intervensi }}')"
                                                class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>

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
                </div>
                <!-- PAGINATION -->
                <div class="px-6 py-4 border-t border-gray-200 bg-white">
                    @include('layouts.wakasek.pagination', ['data' => $intervensi])
                </div>
            </div>
        </div>
        @include('wakasek.intervensi.create')
        @include('wakasek.intervensi.edit')
        @include('wakasek.intervensi.delete')
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

        function openEditModal(id_intervensi, nis, nama_intervensi, isi_intervensi, status, tanggal_Mulai_Perbaikan,
            tanggal_Selesai_Perbaikan, perubahan_setelah_intervensi) {
            document.getElementById('nis_edit').value = nis;
            document.getElementById('nama_intervensi_edit').value = nama_intervensi;
            document.getElementById('isi_intervensi_edit').value = isi_intervensi;
            document.getElementById('status_edit').value = status;
            document.getElementById('tanggal_Mulai_Perbaikan_edit').value = tanggal_Mulai_Perbaikan;
            document.getElementById('tanggal_Selesai_Perbaikan_edit').value = tanggal_Selesai_Perbaikan;
            document.getElementById('perubahan_setelah_intervensi_edit').value = perubahan_setelah_intervensi || '';

            togglePerubahanFieldEdit();

            document.getElementById('form-edit').action = `/intervensi/${id_intervensi}/update`;
            openModal('modal-edit');
        }

        function togglePerubahanFieldEdit() {
            const status = document.getElementById('status_edit').value;
            const perubahanField = document.getElementById('perubahan-field-edit');
            const perubahanTextarea = document.getElementById('perubahan_setelah_intervensi_edit');

            if (status === 'Selesai') {
                perubahanField.classList.remove('hidden');
                perubahanTextarea.setAttribute('required', 'required');
            } else {
                perubahanField.classList.add('hidden');
                perubahanTextarea.removeAttribute('required');
                perubahanTextarea.value = '';
            }
        }

        function openDeleteModal(id_intervensi, nis, nama_intervensi) {
            document.getElementById('delete-nama-intervensi').innerText = nama_intervensi;
            document.getElementById('form-delete').action = `/intervensi/${id_intervensi}/destroy`;
            openModal('modal-delete');
        }





        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete',

            ].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete', ].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
    </script>
