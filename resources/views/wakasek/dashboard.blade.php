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
                    {{-- <p class="text-2xl font-bold text-blue-600">{{ number_format($rataSkor, 1) }}</p> --}}
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="bi bi-bar-chart text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Apresiasi Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Apresiasi per Jurusan</h3>
                <div class="flex bg-gray-100 rounded-lg p-1">
                    <button
                        class="toggle-btn px-3 py-1 rounded-md text-sm font-medium bg-white text-blue-500">Minggu</button>
                    <button class="toggle-btn px-3 py-1 rounded-md text-sm font-medium text-gray-600">Bulan</button>
                </div>
            </div>
            <div style="height: 300px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Pelanggaran Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Pelanggaran per Jurusan</h3>
                <div class="flex bg-gray-100 rounded-lg p-1">
                    <button
                        class="toggle-btn px-3 py-1 rounded-md text-sm font-medium bg-white text-blue-500">Minggu</button>
                    <button class="toggle-btn px-3 py-1 rounded-md text-sm font-medium text-gray-600">Bulan</button>
                </div>
            </div>
            <div style="height: 300px;">
                <canvas id="expenseChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-8">
        <div class="bg-white rounded-xl shadow-sm border">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">Ahmad Rizki mendapat apresiasi "Juara 1 Lomba Programming"
                            </p>
                            <p class="text-gray-500 text-sm">2 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">Siti Nurhaliza mendapat pelanggaran "Terlambat masuk kelas"
                            </p>
                            <p class="text-gray-500 text-sm">5 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-gray-900 font-medium">Budi Santoso mendapat apresiasi "Siswa Teladan Bulan Ini"
                            </p>
                            <p class="text-gray-500 text-sm">10 menit yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
