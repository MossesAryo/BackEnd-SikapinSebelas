@extends('layouts.app')

@push('css')
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Gradient background */
        .gradient-bg {
            background: #0083ee;
            border-radius: 12px;

        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass morphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced table styles */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .table-hover tbody tr {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .table-hover tbody tr:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.03) 0%, rgba(59, 130, 246, 0.08) 100%);
            transform: translateX(4px);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        }

        /* Enhanced buttons */
        .btn-primary {
            background: white;
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .btn-custom{
             background: #0083ee;
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }


        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: white;
            border: 2px solid #e2e8f0;
            color: #0083ee;
            transition: all 0.3s ease;
        }


        .btn-secondary:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.05);
            transform: translateY(-1px);
        }

        /* Action buttons */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn-edit {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .action-btn-edit:hover {
            background: rgba(59, 130, 246, 0.2);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .action-btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .action-btn-delete:hover {
            background: rgba(239, 68, 68, 0.2);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Enhanced form inputs */
        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        /* Modal enhancements */
        .modal-content {
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Search and filter section */
        .search-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .table-container {
                margin: -1rem;
                border-radius: 0;
            }

            .action-btn {
                width: 32px;
                height: 32px;
            }
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">

        <!-- Header Section -->
        <div class="gradient-bg px-6 py-8 mb-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="text-white">
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">
                            <i class="bi bi-collection text-white/80 mr-3"></i>
                            Data Jurusan
                        </h1>
                        <p class="text-white/80 text-lg">
                            Kelola dan organisir data jurusan dengan mudah dan efisien
                        </p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-white/70">
                            <span><i class="bi bi-calendar3 mr-1"></i> {{ date('d M Y') }}</span>
                            <span><i class="bi bi-clock mr-1"></i> {{ date('H:i') }}</span>
                        </div>
                    </div>
                    <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                        class="btn-primary text-[#0083ee] px-6 py-3 rounded-xl flex items-center gap-3 font-medium shadow-lg">
                        <i class="bi bi-plus-circle text-lg"></i>
                        <span>Tambah Jurusan Baru</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pb-8 space-y-6">
            <!-- Search and Filter Section -->
            <div class="search-section p-6 rounded-2xl shadow-sm">
                <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-3 flex-1 w-full">
                        <!-- Search Input -->
                        <div class="relative flex-1 min-w-0">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-search text-gray-400 text-lg"></i>
                            </div>
                            <input type="text" placeholder="Cari kelas berdasarkan ID atau nama..."
                                class="form-input w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none text-gray-700 placeholder-gray-400">
                        </div>

                        <!-- Filter Dropdowns -->
                        <div class="flex gap-3">
                            <select
                                class="form-input px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:outline-none min-w-[140px]">
                                <option value="">Semua Jurusan</option>
                                <option value="MPLB">MPLB</option>
                                <option value="AKL">AKL</option>
                                <option value="MLOG">MLOG</option>
                                <option value="PM">PM</option>
                                <option value="RPL">RPL</option>
                                <option value="DKV">DKV</option>
                                <option value="TJKT">TJKT</option>
                            </select>
                            <select
                                class="form-input px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-0 focus:outline-none min-w-[120px]">
                                <option value="">Semua Kelas</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button class="btn-secondary px-5 py-3 rounded-xl flex items-center gap-2 font-medium">
                            <i class="bi bi-funnel"></i>
                            <span>Filter Lanjutan</span>
                        </button>
                        <button class="btn-secondary px-5 py-3 rounded-xl flex items-center gap-2 font-medium">
                            <i class="bi bi-download"></i>
                            <span>Export Data</span>
                        </button>
                    </div>
                </div>
            </div>


            <!-- Table Section -->
            <div class="table-container">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Daftar Jurusan</h3>
                            <p class="text-gray-500 text-sm mt-1">Menampilkan {{ count($jurusan) }} jurusan yang tersedia</p>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="bi bi-info-circle"></i>
                            <span>Hover untuk melihat detail</span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    @if (count($jurusan) > 0)
                        <table class="w-full table-hover">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th
                                        class="w-1/6 px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-hash mr-2"></i>ID Jurusan
                                    </th>
                                    <th
                                        class="w-2/3 px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-tag mr-2"></i>Nama Jurusan
                                    </th>
                                    <th
                                        class="w-1/6 px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-gear mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($jurusan as $item)
                                    <tr class="group">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                                    {{ substr($item->id_jurusan, 0, 1) }}
                                                </div>
                                                <span
                                                    class="text-sm font-semibold text-gray-900">{{ $item->id_jurusan }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-base font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                                    {{ $item->nama_jurusan }}
                                                </span>
                                                <span class="text-sm text-gray-500 mt-1">
                                                    <i class="bi bi-calendar3 mr-1"></i>
                                                    Dibuat pada {{ date('d M Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="javascript:void(0)" class="action-btn action-btn-edit"
                                                    onclick="openEditModal('{{ $item->id_jurusan }}', '{{ $item->nama_jurusan }}')"
                                                    title="Edit Jurusan">
                                                    <i class="bi bi-pencil-square text-sm"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="action-btn action-btn-delete"
                                                    onclick="openDeleteModal('{{ $item->id_jurusan }}', '{{ $item->nama_jurusan }}')"
                                                    title="Hapus Jurusan">
                                                    <i class="bi bi-trash text-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-collection text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Jurusan</h3>
                            <p class="text-gray-500 mb-6">Mulai dengan menambahkan jurusan pertama Anda</p>
                            <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                                class="btn-custom text-white px-6 py-3 rounded-xl font-medium">
                                <i class="bi bi-plus-circle mr-2"></i>
                                Tambah Jurusan Pertama
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@include('wakasek.jurusan.create')
@include('wakasek.jurusan.edit')
@include('wakasek.jurusan.delete')
   

@endsection

@push('js')
    <script>

        function openEditModal(id_jurusan, nama_jurusan) {
            document.getElementById('edit_id_jurusan').value = id_jurusan;
            document.getElementById('edit_nama_jurusan').value = nama_jurusan;
            document.getElementById('form-edit').action = `/jurusan/${id_jurusan}/update`;
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function openDeleteModal(id_jurusan, nama_jurusan) {
            document.getElementById('delete-nama-jurusan').innerText = nama_jurusan;
            document.getElementById('form-delete').action = `/jurusan/${id_jurusan}/delete`;
            document.getElementById('modal-delete').classList.remove('hidden');
        }

        // Enhanced UX: Close modals with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                    modal.classList.add('hidden');
                });
            }
        });

        // Enhanced UX: Click outside to close modal
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endpush
