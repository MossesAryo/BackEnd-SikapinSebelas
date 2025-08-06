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
        <!-- Header -->
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
                    <input type="text" placeholder="Cari Guru BK..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
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

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Guru BK</h3>
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
                                    Username
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    Nama
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
                        @forelse ($guru_bk as $item)
                            <tr class="hover:bg-gray-50 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-2 h-2 bg-blue-400 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $item->nip_bk }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->user->username }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $item->nama_guru_bk }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1">
                                        <button
                                            onclick="openEditModal('{{ $item->nip_bk }}', '{{ $item->username }}', '{{ $item->nama_guru_bk }}')"
                                            class="action-btn inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full"
                                            title="Edit Guru BK">
                                            <i class="bi bi-pencil-square text-sm"></i>
                                        </button>
                                        <button
                                            onclick="openDeleteModal('{{ $item->nip_bk }}', '{{ $item->nama_guru_bk }}')"
                                            class="action-btn inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-full"
                                            title="Hapus Guru BK">
                                            <i class="bi bi-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="bi bi-people text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Guru BK</h3>
                                    <p class="text-gray-500">Tambahkan data Guru BK untuk memulai.</p>
                                </td>
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
