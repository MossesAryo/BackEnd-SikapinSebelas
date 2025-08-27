@extends('layouts.wakasek.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/penghargaan.css') }}">
@endpush

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Data Penghargaan</h1>
                <p class="text-gray-600 mt-1">Kelola data Penghargaan</p>
            </div>
            <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-plus-lg"></i>
                Tambah Penghargaan
            </button>
        </div>

 
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
                        
                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-gear text-gray-400"></i>
                                    Aksi
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
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                </td>
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
    @include('wakasek.penghargaan.create')
    @include('wakasek.penghargaan.edit')
    @include('wakasek.penghargaan.delete')
@endsection

@push('js')
   <script src="{{ asset('js/wakasek/penghargaan.js') }}"></script>
@endpush
