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
                    <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
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
                                <td class="px-3 py-2 text-sm text-gray-700 truncate-cell">{{ $item->nip }}</td>
                                <td class="px-3 py-2 text-sm text-gray-700 truncate-cell">{{ $item->username }}</td>
                                <td class="px-3 py-2 text-sm text-gray-700 truncate-cell">{{ $item->nama }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex gap-2">
                                        <a href="javascript:void(0)"
                                            class="text-blue-600 hover:text-blue-800 action-btn"
                                            onclick="openEditModal('{{ $item->nip }}', '{{ $item->username }}', '{{ $item->nama }}')"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="text-red-600 hover:text-red-800 action-btn"
                                            onclick="openDeleteModal('{{ $item->nip }}', '{{ $item->nama }}')"
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

    <!-- Modal Create Guru BK -->
    <div id="modal-create" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <form action="{{ route('gurubk.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Tambah Guru BK</h2>
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>
                <div class="space-y-2">
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" id="nip" name="nip_bk"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none "
                            required>
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none" required>
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama_guru_bk"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none "
                            required>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Guru BK -->
    <div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl mx-4">
            <form id="form-edit" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Edit Guru BK</h2>
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700 text-xl ">&times;</button>
                </div>
                <div class="space-y-2">
                    <div>
                        <label for="edit_nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" id="edit_nip" name="nip_bk"
                            class=" mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none"
                            readonly>
                    </div>
                    <div>
                        <label for="edit_username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="edit_username" name="username"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none"
                            required>
                    </div>
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="edit_nama" name="nama_guru_bk"
                            class=" mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-1.5 focus:ring focus:ring-blue-200 focus:outline-none"
                            required>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Guru BK -->
    <div id="modal-delete" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">
            <form id="form-delete" method="POST" class="p-6 space-y-4">
                @csrf
                @method('DELETE')
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-700">Hapus Guru BK</h2>
                    <button type="button" onclick="document.getElementById('modal-delete').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>
                <p class="text-gray-600">Apakah kamu yakin ingin menghapus guru <span id="delete-nama-guru"
                        class="font-semibold"></span>?</p>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-delete').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    function openEditModal(nip, username, nama) {
        document.getElementById('edit_nip').value = nip;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('form-edit').action = `/guru-bk/${nip}/update`;
        document.getElementById('modal-edit').classList.remove('hidden');
    }

    function openDeleteModal(nip, nama) {
        document.getElementById('delete-nama-guru').innerText = nama;
        document.getElementById('form-delete').action = `/guru-bk/${nip}`;
        document.getElementById('modal-delete').classList.remove('hidden');
    }
</script>
@endpush
