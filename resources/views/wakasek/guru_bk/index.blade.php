@extends('layouts.app')

@push('css')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: rgba(34, 197, 94, 1);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgba(245, 158, 11, 1);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .badge-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: rgba(239, 68, 68, 1);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .table-fixed {
            table-layout: fixed;
            width: 100%;
        }

        .truncate-cell {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Data Guru BK</h1>
                <p class="text-gray-600 mt-1">Kelola data Guru BK</p>
            </div>
            <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-plus-lg"></i>
                Tambah Guru BK
            </button>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                <div class="flex flex-col md:flex-row gap-2 flex-1">
                    <div class="relative w-full md:w-64">
                        <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                        <input type="text" placeholder="Cari Guru BK..."
                            class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Guru BK</h3>
            </div>

            <div class="overflow-hidden">
                <table class="w-full table-hover table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="w-1/3 px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">NIP</th>
                            <th class="w-1/3 px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                            <th class="w-1/3 px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="w-1/3 px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($guru_bk as $item)
                            <tr>
                                <td class="px-3 py-2 text-sm text-gray-700 truncate-cell">{{ $item->nip_bk }}</td>
                                <td class="px-3 py-2 text-sm text-gray-700 truncate-cell">{{ $item->username }}</td>
                                <td class="px-3 py-2 text-sm text-gray-700 truncate-cell">{{ $item->nama_guru_bk }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex gap-2">
                                        <a href="javascript:void(0)" class="text-blue-600 hover:text-blue-800 action-btn"
                                            onclick="openEditModal('{{ $item->nip_bk }}', '{{ $item->username }}', '{{ $item->nama_guru_bk }}')"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="text-red-600 hover:text-red-800 action-btn"
                                            onclick="openDeleteModal('{{ $item->nip_bk }}', '{{ $item->nama_guru_bk }}')"
                                            title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
        function openEditModal(nip, username, nama) {
            document.getElementById('edit_nip_bk').value = nip;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_nama_guru_bk').value = nama;
            document.getElementById('form-edit').action = `/gurubk/${nip}/update`;
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function openDeleteModal(nip, nama) {
            document.getElementById('delete-nama-guru').innerText = nama;
            document.getElementById('form-delete').action = `/gurubk/${nip}/destroy`;
            document.getElementById('modal-delete').classList.remove('hidden');
        }
    </script>
@endpush
