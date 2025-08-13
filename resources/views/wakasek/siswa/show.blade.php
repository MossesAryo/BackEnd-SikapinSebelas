@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/siswa.css') }}">
@endpush

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Detail Siswa</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap data siswa</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('siswa.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Student Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <h3 class="text-lg font-semibold text-gray-900">Profil Siswa</h3>
                    </div>

                    <div class="p-6">
                        <!-- Student Photo -->
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center">
                                    <i class="bi bi-person-fill text-4xl text-white"></i>
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <i class="bi bi-check text-white text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Student Basic Info -->
                        <div class="text-center mb-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $siswa->nama_siswa }}</h2>
                            <p class="text-gray-600">NIS: {{ $siswa->nis }}</p>
                            <p class="text-gray-600">Absen : 1</p>
                            <div class="mt-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="bi bi-mortarboard mr-2"></i>
                                    {{ $siswa->kelas->nama_kelas }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="text-center">
                            @php
                                $poinTotal = $siswa->poin_total ?? 0;
                            @endphp


                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-person-lines-fill text-blue-600"></i>
                            Informasi Personal
                        </h3>
                        <button
                            onclick="openEditModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}', '{{ $siswa->id_kelas }}')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                            <i class="bi bi-pencil-square"></i>
                            Edit Data
                        </button>
                    </div>


                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-hash text-gray-400"></i>
                                    <span class="text-sm text-gray-900">{{ $siswa->nis }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    <span class="text-sm text-gray-900">{{ $siswa->nama_siswa }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-door-open text-gray-400"></i>
                                    <span class="text-sm text-gray-900">{{ $siswa->kelas->nama_kelas }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Wali Kelas</label>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person-badge text-gray-400"></i>
                                    <span
                                        class="text-sm text-gray-900">{{ $siswa->kelas->wali_kelas ?? 'Belum ditentukan' }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-calendar text-gray-400"></i>
                                    <span class="text-sm text-gray-900">{{ $siswa->tahun_masuk ?? '2023' }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-circle-fill text-green-500 text-xs"></i>
                                    <span class="text-sm text-gray-900">Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Point Statistics -->
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-graph-up text-blue-600"></i>
                            Statistik Poin
                        </h3>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div
                                class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-lg border border-green-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-green-600 text-sm font-medium">Poin Positif</p>
                                        <p class="text-2xl font-bold text-green-700">{{ $siswa->poin_positif ?? 0 }}</p>
                                    </div>
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="bi bi-plus-circle-fill text-green-600 text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-red-50 to-rose-50 p-4 rounded-lg border border-red-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-red-600 text-sm font-medium">Poin Negatif</p>
                                        <p class="text-2xl font-bold text-red-700">{{ $siswa->poin_negatif ?? 0 }}</p>
                                    </div>
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="bi bi-dash-circle-fill text-red-600 text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-blue-600 text-sm font-medium">Total Poin</p>
                                        <p class="text-2xl font-bold text-blue-700">{{ $poinTotal }}</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="bi bi-calculator-fill text-blue-600 text-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-clock-history text-blue-600"></i>
                            Aktivitas Terakhir
                        </h3>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Example activities - replace with actual data -->
                            <div class="flex items-start gap-3 p-3 bg-green-50 rounded-lg border border-green-200">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-green-800">Prestasi Akademik</p>
                                    <p class="text-xs text-green-600">Juara 1 Olimpiade Matematika - +50 poin</p>
                                    <p class="text-xs text-gray-500">2 hari yang lalu</p>
                                </div>
                                <span class="text-green-600 font-bold text-sm">+50</span>
                            </div>

                            <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-800">Kehadiran</p>
                                    <p class="text-xs text-blue-600">Hadir tepat waktu - +5 poin</p>
                                    <p class="text-xs text-gray-500">1 minggu yang lalu</p>
                                </div>
                                <span class="text-blue-600 font-bold text-sm">+5</span>
                            </div>

                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="w-2 h-2 bg-gray-400 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-700">Tidak ada aktivitas lainnya</p>
                                    <p class="text-xs text-gray-500">Siswa menunjukkan perilaku yang baik</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="#"
                                class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                                Lihat semua aktivitas
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
            <button onclick="openDeleteModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-trash"></i>
                Hapus Siswa
            </button>
            <button onclick="window.print()"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-printer"></i>
                Cetak Data
            </button>
        </div>
    </div>

    @include('wakasek.siswa.edit')
    @include('wakasek.siswa.delete')
@endsection

@push('js')
    <script src="{{ asset('js/wakasek/siswa.js') }}"></script>
@endpush
