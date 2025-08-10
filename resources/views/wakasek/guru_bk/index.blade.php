@extends('layouts.app')

@push('css')
    <style>
        .table-hover tbody tr:hover {
            background: rgba(59, 130, 246, .05);
            transition: all .2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
            transition: all .2s ease;
        }

        .badge {
            font-size: .75rem;
            padding: .25rem .5rem;
            border-radius: .375rem;
            font-weight: 500;
        }

        .badge-success {
            background: rgba(34, 197, 94, .1);
            color: rgb(34, 197, 94);
            border: 1px solid rgba(34, 197, 94, .2);
        }

        .badge-warning {
            background: rgba(245, 158, 11, .1);
            color: rgb(245, 158, 11);
            border: 1px solid rgba(245, 158, 11, .2);
        }

        .badge-danger {
            background: rgba(239, 68, 68, .1);
            color: rgb(239, 68, 68);
            border: 1px solid rgba(239, 68, 68, .2);
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Data Guru BK</h1>
                <p class="text-gray-600">Kelola data Guru BK</p>
            </div>
            <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Guru BK
            </button>
        </div>

        @if (session('success'))
            <p class="text-sm text-green-600 font-semibold">✅ {{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="text-sm text-red-600 font-semibold">❌ {{ session('error') }}</p>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-sm border flex flex-col md:flex-row gap-2 items-center justify-between">
            <div class="relative w-full md:w-64">
                <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                <input type="text" placeholder="Cari Guru BK..." class="pl-10 pr-4 py-1.5 border rounded-lg w-full">
            </div>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 border rounded-lg hover:bg-gray-50 flex items-center gap-1.5"><i
                        class="bi bi-funnel"></i> Filter</button>
                <button class="px-3 py-1.5 border rounded-lg hover:bg-gray-50 flex items-center gap-1.5"><i
                        class="bi bi-download"></i> Export</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Daftar Guru BK</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-hover">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold">NIP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guru_bk as $item)
                            <tr>
                                <td class="px-6 py-4">{{ $item->nip_bk }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $item->user->username }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $item->nama_guru_bk }}</td>
                                <td class="px-6 py-4 flex items-center gap-1">
                                    <button
                                        onclick="openEditModal('{{ $item->nip_bk }}', '{{ $item->username }}', '{{ $item->nama_guru_bk }}')"
                                        class="action-btn w-9 h-9 text-blue-600 hover:bg-blue-50 rounded-full"><i
                                            class="bi bi-pencil-square text-sm"></i></button>
                                    <button onclick="openDeleteModal('{{ $item->nip_bk }}', '{{ $item->nama_guru_bk }}')"
                                        class="action-btn w-9 h-9 text-red-600 hover:bg-red-50 rounded-full"><i
                                            class="bi bi-trash text-sm"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada data Guru BK</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('wakasek.guru_bk.create')
    @include('wakasek.guru_bk.edit')
    @include('wakasek.guru_bk.delete')
@endsection

@push('js')
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            openModal('modal-create');
        }

        function openEditModal(nip, username, nama) {
            edit_nip_bk.value = nip;
            edit_username.value = username;
            edit_nama_guru_bk.value = nama;
            form_edit.action = `/gurubk/${nip}/update`;
            modal_edit.classList.remove('hidden');
        }

        function openDeleteModal(nip, nama) {
            document.getElementById('delete-nama-guru').innerText = nama;
            form_delete.action = `/gurubk/${nip}/destroy`;
            modal_delete.classList.remove('hidden');
        }
    </script>
@endpush
