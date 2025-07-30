@extends('layouts.app')

@push('css')
    <style>
        .form-card {
            transition: all 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            transform: translateY(-1px);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #0083ee;
            box-shadow: 0 0 0 3px rgba(0, 131, 238, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0083ee, #0a50c1);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 131, 238, 0.3);
        }

        .breadcrumb-item {
            transition: color 0.3s ease;
        }

        .breadcrumb-item:hover {
            color: #0083ee;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold gradient-text mb-2">Tambah Kelas Baru</h1>
                    <p class="text-gray-600">Masukkan informasi kelas yang akan ditambahkan ke sistem</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="bi bi-journal-plus text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1">
            <!-- Form Card -->
            <div class="w-full">
                <div class="form-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="bi bi-pencil-square text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Kelas</h3>
                                <p class="text-sm text-gray-600">Lengkapi form di bawah untuk menambahkan kelas baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6">
                        <form action="" method="POST" class="space-y-6">
                            @csrf

                            <!-- ID Kelas -->
                            <div class="input-group">
                                <label for="id_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="bi bi-hash mr-1"></i>
                                    ID Kelas
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="id_kelas" name="id_kelas"
                                        class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                        placeholder="Masukkan ID kelas (contoh: 101)" required
                                        value="{{ old('id_kelas') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="bi bi-123 text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">ID kelas harus berupa angka dan unik</p>
                            </div>

                            <!-- Nama Kelas -->
                            <div class="input-group">
                                <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="bi bi-tag mr-1"></i>
                                    Nama Kelas
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" id="nama_kelas" name="nama_kelas"
                                        class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                        placeholder="Masukkan nama kelas (contoh: X RPL 1)" required
                                        value="{{ old('nama_kelas') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="bi bi-fonts text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Masukkan nama kelas yang jelas dan mudah diidentifikasi</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <a href="{{ route('kelas') }}"
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                    <i class="bi bi-arrow-left mr-2"></i>
                                    Kembali
                                </a>
                                <div class="flex space-x-3">
                                    <button type="reset"
                                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                                        <i class="bi bi-arrow-clockwise mr-2"></i>
                                        Reset
                                    </button>
                                    <button type="submit"
                                        class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="bi bi-check-circle mr-2"></i>
                                        Simpan Kelas
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
