@extends('layouts.app')



@section('main')
    
     <div class="p-8 max-w-7xl">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Siswa -->
                    <div class="stat-card relative bg-white rounded-2xl p-6 shadow-sm border border-gray-200 stat-card-hover transition-all duration-300 overflow-hidden">
                        <div class="flex justify-between items-start mb-5">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                                <i class="bi bi-mortarboard-fill text-xl"></i>
                            </div>
                            <div class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-1">
                                <i class="bi bi-arrow-up"></i>
                                12.5%
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-2">1,580</div>
                        <div class="text-gray-600 font-medium">Total Siswa</div>
                    </div>

                    <!-- Siswa Apresiasi -->
                    <div class="stat-card relative bg-white rounded-2xl p-6 shadow-sm border border-gray-200 stat-card-hover transition-all duration-300 overflow-hidden">
                        <div class="flex justify-between items-start mb-5">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                                <i class="bi bi-award-fill text-xl"></i>
                            </div>
                            <div class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-1">
                                <i class="bi bi-arrow-up"></i>
                                8.2%
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-2">247</div>
                        <div class="text-gray-600 font-medium">Siswa Apresiasi</div>
                    </div>

                    <!-- Siswa Melanggar -->
                    <div class="stat-card relative bg-white rounded-2xl p-6 shadow-sm border border-gray-200 stat-card-hover transition-all duration-300 overflow-hidden">
                        <div class="flex justify-between items-start mb-5">
                            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                                <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                            </div>
                            <div class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-1">
                                <i class="bi bi-arrow-up"></i>
                                15.3%
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-2">92</div>
                        <div class="text-gray-600 font-medium">Siswa Melanggar</div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Apresiasi Chart -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Grafik Apresiasi Siswa</h3>
                            <div class="bg-blue-500 rounded-full p-1 flex">
                                <button class="toggle-btn px-3 py-1 text-sm font-medium rounded-full transition-all bg-white text-blue-500">Minggu</button>
                                <button class="toggle-btn px-3 py-1 text-sm font-medium rounded-full transition-all text-white">Bulan</button>
                            </div>
                        </div>
                        <div class="h-64">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Pelanggaran Chart -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Grafik Pelanggaran Siswa</h3>
                            <div class="bg-blue-500 rounded-full p-1 flex">
                                <button class="toggle-btn px-3 py-1 text-sm font-medium rounded-full transition-all bg-white text-blue-500">Minggu</button>
                                <button class="toggle-btn px-3 py-1 text-sm font-medium rounded-full transition-all text-white">Bulan</button>
                            </div>
                        </div>
                        <div class="h-64">
                            <canvas id="expenseChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Activity Section -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                    <div class="mb-6 pb-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Aktivitas Sistem Skoring</h3>
                    </div>
                    <div class="space-y-4">
                        <!-- Activity Item 1 -->
                        <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-box-arrow-in-right text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">User <strong>Andi</strong> berhasil login</div>
                                <div class="text-xs text-gray-500">5 menit lalu</div>
                            </div>
                        </div>

                        <!-- Activity Item 2 -->
                        <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">Pelanggaran oleh <strong>Rina</strong>: Datang terlambat</div>
                                <div class="text-xs text-gray-500">20 menit lalu</div>
                            </div>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-award-fill text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">Apresiasi untuk <strong>Budi</strong>: Disiplin dan aktif</div>
                                <div class="text-xs text-gray-500">45 menit lalu</div>
                            </div>
                        </div>

                        <!-- Activity Item 4 -->
                        <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-box-arrow-in-right text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">User <strong>Siti</strong> berhasil login</div>
                                <div class="text-xs text-gray-500">1 jam lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
