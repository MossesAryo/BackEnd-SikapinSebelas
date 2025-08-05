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

        .btn-custom {
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

        /* Badge styles */
        .badge-jurusan {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            gap: 0.25rem;
        }

        .badge-tjkt {
            background: rgba(59, 130, 246, 0.1);
            color: #1d4ed8;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .badge-rpl {
            background: rgba(34, 197, 94, 0.1);
            color: #166534;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .badge-dkv {
            background: rgba(168, 85, 247, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(168, 85, 247, 0.2);
        }

        .badge-akl {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .badge-mlog {
            background: rgba(6, 182, 212, 0.1);
            color: #0369a1;
            border: 1px solid rgba(6, 182, 212, 0.2);
        }

        .badge-pm {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .badge-mplb {
            background: rgba(14, 165, 233, 0.1);
            color: #0284c7;
            border: 1px solid rgba(14, 165, 233, 0.2);
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
                            <i class="bi bi-person-badge text-white/80 mr-3"></i>
                            Data Ketua Program
                        </h1>
                        <p class="text-white/80 text-lg">
                            Kelola data ketua program keahlian dengan mudah dan efisien
                        </p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-white/70">
                            <span><i class="bi bi-calendar3 mr-1"></i> {{ date('d M Y') }}</span>
                            <span><i class="bi bi-clock mr-1"></i> {{ date('H:i') }}</span>
                        </div>
                    </div>
                    <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                        class="btn-primary text-[#0083ee] px-6 py-3 rounded-xl flex items-center gap-3 font-medium shadow-lg">
                        <i class="bi bi-plus-circle text-lg"></i>
                        <span>Tambah Ketua Program</span>
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
                            <input type="text" placeholder="Cari ketua program berdasarkan nama atau NIP..."
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
                            <h3 class="text-xl font-bold text-gray-900">Daftar Ketua Program</h3>
                            <p class="text-gray-500 text-sm mt-1">Menampilkan {{ $ketua_program->count() }} ketua program
                                yang tersedia</p>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="bi bi-info-circle"></i>
                            <span>Hover untuk melihat detail</span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    @if ($ketua_program->count() > 0)
                        <table class="w-full table-hover">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th
                                        class="w-1/6 px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-person-badge mr-2"></i>NIP
                                    </th>
                                    <th
                                        class="w-1/3 px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-person mr-2"></i>Nama
                                    </th>
                                    <th
                                        class="w-1/6 px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-building mr-2"></i>Jurusan
                                    </th>
                                    <th
                                        class="w-1/6 px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-person-circle mr-2"></i>Username
                                    </th>
                                    <th
                                        class="w-1/6 px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <i class="bi bi-gear mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($ketua_program as $kaprog)
                                    <tr class="group">
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm font-semibold text-gray-900">{{ $kaprog->nip_kaprog }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                                    {{ strtoupper(substr($kaprog->nama_ketua_program, 0, 2)) }}
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-base font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                                        {{ $kaprog->nama_ketua_program }}
                                                    </span>
                                                    <span class="text-sm text-gray-500 mt-1">
                                                        <i class="bi bi-calendar3 mr-1"></i>
                                                        Ketua Program
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="badge-jurusan badge-{{ strtolower($kaprog->jurusan) }}">
                                                <i class="bi bi-mortarboard"></i>
                                                {{ strtoupper($kaprog->jurusan) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-900">
                                                {{ $kaprog->user->username ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="javascript:void(0)" class="action-btn action-btn-edit"
                                                    onclick="openEditModal('{{ $kaprog->nip_kaprog }}', '{{ $kaprog->nama_ketua_program }}', '{{ $kaprog->jurusan }}', '{{ $kaprog->user->username ?? '' }}')"
                                                    title="Edit Ketua Program">
                                                    <i class="bi bi-pencil-square text-sm"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="action-btn action-btn-delete"
                                                    onclick="openDeleteModal('{{ $kaprog->nip_kaprog }}', '{{ $kaprog->nama_ketua_program }}')"
                                                    title="Hapus Ketua Program">
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
                                <i class="bi bi-person-badge text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Ketua Program</h3>
                            <p class="text-gray-500 mb-6">Mulai dengan menambahkan ketua program pertama</p>
                            <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                                class="btn-custom text-white px-6 py-3 rounded-xl font-medium">
                                <i class="bi bi-plus-circle mr-2"></i>
                                Tambah Ketua Program Pertama
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Ketua Program -->
    <div id="modal-create"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-lg">
            <form action="{{ route('wakasek.kaprog.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold gradient-text">Tambah Ketua Program</h2>
                        <p class="text-gray-500 mt-1">Isi informasi ketua program yang akan ditambahkan</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                        class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="nip_kaprog" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-person-badge mr-1"></i>NIP Kaprog
                        </label>
                        <input type="text" id="nip_kaprog" name="nip_kaprog"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none placeholder-gray-400"
                            placeholder="Contoh: 198501012020121001" required>
                        <p class="text-xs text-gray-500 mt-1">Masukkan NIP yang valid</p>
                    </div>

                    <div>
                        <label for="nama_ketua_program" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-person mr-1"></i>Nama Ketua Program
                        </label>
                        <input type="text" id="nama_ketua_program" name="nama_ketua_program"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none placeholder-gray-400"
                            placeholder="Contoh: Dr. Ahmad Budiman, S.Pd., M.Kom" required>
                        <p class="text-xs text-gray-500 mt-1">Nama lengkap dengan gelar</p>
                    </div>

                    <div>
                        <label for="jurusan" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-building mr-1"></i>Jurusan
                        </label>
                        <select id="jurusan" name="jurusan"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none"
                            required>
                            <option value="">Pilih Jurusan</option>
                            <option value="MPLB">MPLB - Manajemen Perkantoran dan Layanan Bisnis</option>
                            <option value="AKL">AKL - Akuntansi dan Keuangan Lembaga</option>
                            <option value="MLOG">MLOG - Manajemen Logistik</option>
                            <option value="PM">PM - Pemasaran</option>
                            <option value="RPL">RPL - Rekayasa Perangkat Lunak</option>
                            <option value="DKV">DKV - Desain Komunikasi Visual</option>
                            <option value="TJKT">TJKT - Teknik Jaringan Komputer dan Telekomunikasi</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih program keahlian yang akan dipimpin</p>
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-person-circle mr-1"></i>Username
                        </label>
                        <input type="text" id="username" name="username"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none placeholder-gray-400"
                            placeholder="Contoh: kaprog_rpl" required>
                        <p class="text-xs text-gray-500 mt-1">Username untuk login sistem</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')"
                        class="flex-1 btn-secondary py-3 rounded-xl font-medium">
                        <i class="bi bi-x-circle mr-2"></i>Batal
                    </button>
                    <button type="submit" class="flex-1 btn-custom text-white py-3 rounded-xl font-medium">
                        <i class="bi bi-check-circle mr-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Edit Ketua Program -->
    <div id="modal-edit"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-lg">
            <form id="form-edit" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold gradient-text">Edit Ketua Program</h2>
                        <p class="text-gray-500 mt-1">Perbarui informasi ketua program yang dipilih</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="edit_nip_kaprog" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-person-badge mr-1"></i>NIP Kaprog
                        </label>
                        <input type="text" id="edit_nip_kaprog" name="nip_kaprog"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-300 bg-gray-50" readonly>
                        <p class="text-xs text-gray-500 mt-1">NIP tidak dapat diubah</p>
                    </div>

                    <div>
                        <label for="edit_nama_ketua_program" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-person mr-1"></i>Nama Ketua Program
                        </label>
                        <input type="text" id="edit_nama_ketua_program" name="nama_ketua_program"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="edit_jurusan" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-building mr-1"></i>Jurusan
                        </label>
                        <select id="edit_jurusan" name="jurusan"
                            class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:outline-none"
                            required>
                            <option value="">Pilih Jurusan</option>
                            <option value="MPLB">MPLB - Manajemen Perkantoran dan Layanan Bisnis</option>
                            <option value="AKL">AKL - Akuntansi dan Keuangan Lembaga</option>
                            <option value="MLOG">MLOG - Manajemen Logistik</option>
                            <option value="PM">PM - Pemasaran</option>
                            <option value="RPL">RPL - Rekayasa Perangkat Lunak</option>
                            <option value="DKV">DKV - Desain Komunikasi Visual</option>
                            <option value="TJKT">TJKT - Teknik Jaringan Komputer dan Telekomunikasi</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="flex-1 btn-secondary py-3 rounded-xl font-medium">
                        <i class="bi bi-x-circle mr-2"></i>Batal
                    </button>
                    <button type="submit" class="flex-1 btn-custom text-white py-3 rounded-xl font-medium">
                        <i class="bi bi-check-circle mr-2"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Ketua Program -->
    <div id="modal-delete"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-md">
            <form id="form-delete" method="POST" class="p-8 space-y-6">
                @csrf
                @method('DELETE')
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Hapus</h2>
                    <p class="text-gray-600 mb-1">Apakah Anda yakin ingin menghapus ketua program</p>
                    <p class="font-semibold text-red-600 text-lg" id="delete-nama-kaprog"></p>
                    <p class="text-sm text-gray-500 mt-3">Tindakan ini tidak dapat dibatalkan</p>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('modal-delete').classList.add('hidden')"
                        class="flex-1 btn-secondary py-3 rounded-xl font-medium">
                        <i class="bi bi-arrow-left mr-2"></i>Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-medium transition-all duration-300 hover:transform hover:-translate-y-0.5">
                        <i class="bi bi-trash mr-2"></i>Hapus Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function openEditModal(nip, nama, jurusan, username) {
            document.getElementById('edit_nip_kaprog').value = nip;
            document.getElementById('edit_nama_ketua_program').value = nama;
            document.getElementById('edit_jurusan').value = jurusan;
            document.getElementById('form-edit').action = `/wakasek/kaprog/${nip}`;
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function openDeleteModal(nip, nama) {
            document.getElementById('delete-nama-kaprog').innerText = nama;
            document.getElementById('form-delete').action = `/wakasek/kaprog/${nip}`;
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

        // Success message auto hide
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 300);
                }, 5000);
            }
        });
    </script>
@endpush
