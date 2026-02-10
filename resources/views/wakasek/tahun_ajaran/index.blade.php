@php
    $preview = $preview ?? [
        'x_ke_xi' => 0,
        'xi_ke_xii' => 0,
        'alumni' => 0,
    ];

    $belumDiproses = $belumDiproses ?? false;
@endphp


@extends('layouts.wakasek.app')

@push('css')
@endpush

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold gradient-text">Kenaikan Kelas</h1>
                <p class="text-gray-600 mt-1">Proses kenaikan kelas dan kelulusan siswa</p>
            </div>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <p class="text-sm font-semibold flex items-center gap-2">
                    <i class="bi bi-check-circle-fill text-green-600"></i>
                    {{ session('success') }}
                </p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <p class="text-sm font-semibold flex items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                    {{ session('error') }}
                </p>
            </div>
        @endif

        <!-- Preview Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-bar-chart-fill text-blue-600"></i>
                    Preview Kenaikan Kelas
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 rounded-lg border bg-blue-50">
                    <p class="text-sm text-gray-600">Siswa X → XI</p>
                    <p class="text-2xl font-bold text-blue-700">
                        {{ $preview['x_ke_xi'] }}
                    </p>
                </div>

                <div class="p-4 rounded-lg border bg-indigo-50">
                    <p class="text-sm text-gray-600">Siswa XI → XII</p>
                    <p class="text-2xl font-bold text-indigo-700">
                        {{ $preview['xi_ke_xii'] }}
                    </p>
                </div>

                <div class="p-4 rounded-lg border bg-green-50">
                    <p class="text-sm text-gray-600">Siswa Lulus (Alumni)</p>
                    <p class="text-2xl font-bold text-green-700">
                        {{ $preview['alumni'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Card -->
        <div class="bg-white rounded-xl shadow-sm border">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-gear-fill text-gray-600"></i>
                    Aksi
                </h3>
            </div>

            <div class="px-6 py-6">
                <button type="button" onclick="openKenaikanModal()" @if (!$belumDiproses) disabled @endif
                    class="px-6 py-3 rounded-lg text-white font-semibold flex items-center gap-2 transition
                    {{ $belumDiproses ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-400 cursor-not-allowed' }}">
                    <i class="bi bi-arrow-up-circle"></i>
                    {{ $belumDiproses ? 'Proses Kenaikan Kelas' : 'Kenaikan Kelas Sudah Diproses' }}
                </button>


                <p class="mt-4 text-sm text-gray-500">
                    <i class="bi bi-info-circle"></i>
                    Pastikan data kelas sudah lengkap sebelum menjalankan proses ini.
                </p>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Kenaikan Kelas -->
    <div id="kenaikanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 flex items-center justify-center">

        <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-4">
            <div class="px-6 py-4 border-b flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                <h3 class="text-lg font-semibold">Konfirmasi Kenaikan Kelas</h3>
            </div>

            <div class="px-6 py-5 text-sm text-gray-700 space-y-2">
                <p>
                    Proses ini akan:
                </p>
                <ul class="list-disc pl-5 text-gray-600">
                    <li>Menaikkan siswa kelas X ke XI</li>
                    <li>Menaikkan siswa kelas XI ke XII</li>
                    <li>Mengubah siswa kelas XII menjadi <b>Alumni</b></li>
                </ul>
                <p class="text-red-600 font-semibold">
                    Proses ini tidak bisa dibatalkan.
                </p>
            </div>

            <div class="px-6 py-4 border-t flex justify-end gap-2">
                <button onclick="closeKenaikanModal()" class="px-4 py-2 rounded-lg border hover:bg-gray-50">
                    Batal
                </button>

                <form method="POST" action="{{ route('tahun_ajaran.proses') }}">
                    @csrf
                    <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 flex items-center gap-2">
                        <i class="bi bi-check-circle"></i>
                        Ya, Proses
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function openKenaikanModal() {
            document.getElementById('kenaikanModal').classList.remove('hidden');
        }

        function closeKenaikanModal() {
            document.getElementById('kenaikanModal').classList.add('hidden');
        }
    </script>
@endpush
