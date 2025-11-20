@extends('layouts.wakasek.app')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Siswa -->
        <div class="stat-card stat-card-hover bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalSiswa) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="bi bi-people text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Apresiasi -->
        <div class="stat-card stat-card-hover bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Berprestasi</p>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($totalApresiasi) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="bi bi-award text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pelanggaran -->
        <div class="stat-card stat-card-hover bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Pelanggar</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($totalPelanggaran) }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="bi bi-exclamation-triangle text-red-600 text-xl"></i>
                </div>
            </div>
        </div>


        <!-- Rata-rata Skor -->
        <div class="stat-card stat-card-hover bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Rata-rata Skor</p>
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($rataSkor) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="bi bi-bar-chart text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
<div class="mt-8">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Tambah Penghargaan -->
            <a href="{{ route('penghargaan.index') }}" 
                class="group bg-green-50 hover:bg-green-100 border border-green-200 rounded-xl p-4 flex flex-col items-center justify-center text-center transition-all">
                <div class="w-10 h-10 flex items-center justify-center bg-green-200 text-green-700 rounded-full mb-2">
                    <i class="bi bi-award text-xl"></i>
                </div>
                <p class="text-sm font-medium text-green-800 group-hover:text-green-900">Tambah Penghargaan</p>
            </a>

            <!-- Tambah Pelanggaran -->
            <a href="{{ route('peringatan.index') }}" 
                class="group bg-red-50 hover:bg-red-100 border border-red-200 rounded-xl p-4 flex flex-col items-center justify-center text-center transition-all">
                <div class="w-10 h-10 flex items-center justify-center bg-red-200 text-red-700 rounded-full mb-2">
                    <i class="bi bi-exclamation-triangle text-xl"></i>
                </div>
                <p class="text-sm font-medium text-red-800 group-hover:text-red-900">Tambah Pelanggaran</p>
            </a>

            <!-- Lihat Data Siswa -->
            <a href="{{ route('siswa.index') }}" 
                class="group bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-xl p-4 flex flex-col items-center justify-center text-center transition-all">
                <div class="w-10 h-10 flex items-center justify-center bg-blue-200 text-blue-700 rounded-full mb-2">
                    <i class="bi bi-people text-xl"></i>
                </div>
                <p class="text-sm font-medium text-blue-800 group-hover:text-blue-900">Data Siswa</p>
            </a>

            <!-- Export Laporan -->
            <a href="{{ route('laporan.index') }}" 
                class="group bg-yellow-50 hover:bg-yellow-100 border border-yellow-200 rounded-xl p-4 flex flex-col items-center justify-center text-center transition-all">
                <div class="w-10 h-10 flex items-center justify-center bg-yellow-200 text-yellow-700 rounded-full mb-2">
                    <i class="bi bi-file-earmark-text text-xl"></i>
                </div>
                <p class="text-sm font-medium text-yellow-800 group-hover:text-yellow-900">Export Laporan</p>
            </a>

            <!-- Notifikasi -->
            <a href="{{ route('notifikasi.index') }}" 
                class="group bg-purple-50 hover:bg-purple-100 border border-purple-200 rounded-xl p-4 flex flex-col items-center justify-center text-center transition-all">
                <div class="w-10 h-10 flex items-center justify-center bg-purple-200 text-purple-700 rounded-full mb-2">
                    <i class="bi bi-bell text-xl"></i>
                </div>
                <p class="text-sm font-medium text-purple-800 group-hover:text-purple-900">Lihat Notifikasi</p>
            </a>
        </div>
    </div>
</div>


    <!-- Recent Activity -->
<div class="mt-8">
    <div class="bg-white rounded-xl shadow-sm border">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Skoring Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse ($recentActivities as $log)
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 rounded-full 
                            {{ $log->kategori === 'Pelanggaran' ? 'bg-red-500' : 'bg-green-500' }}">
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">
                                <span class="font-semibold">{{ Str::upper($log->siswa->nama_siswa ?? $log->nis)  }} Kelas {{ Str::upper($log->siswa->kelas->nama_kelas) }}</span>
                                mendapat 
                                {{ strtolower($log->kategori) }} 
                                "<span class="italic">{{ $log->description }}</span>"
                            </p>
                            <p class="text-gray-500 text-sm">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">Belum ada aktivitas terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
