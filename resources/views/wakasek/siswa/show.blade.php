@extends('layouts.wakasek.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/siswa.css') }}">
@endpush

@section('content')
    <div class="space-y-4 sm:space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold gradient-text">Detail Siswa</h1>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Informasi lengkap data siswa</p>
            </div>
            <a href="{{ route('siswa.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center justify-center sm:justify-start gap-2 transition-colors w-full sm:w-auto">
                <i class="bi bi-arrow-left"></i>
                <span class="sm:inline">Kembali</span>
            </a>
        </div>

        {{-- Flash Messages --}}
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

        {{-- Main Layout --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 lg:gap-6 max-w-full">
            {{-- Student Profile Card --}}
            <div class="xl:col-span-1 order-2 xl:order-1">
                <div class="space-y-4 lg:space-y-6">
                    {{-- Profile Card --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="p-4 sm:p-6">
                            {{-- Student Photo --}}
                            <div class="flex justify-center mb-4 sm:mb-6">
                                <div class="relative">
                                    <div
                                        class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center">
                                        <i class="bi bi-person-fill text-2xl sm:text-4xl text-white"></i>
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 w-6 h-6 sm:w-8 sm:h-8 bg-green-500 rounded-full border-2 sm:border-4 border-white flex items-center justify-center">
                                        <i class="bi bi-check text-white text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Student Name --}}
                            <div class="text-center mb-4">
                                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-1 break-words">
                                    {{ $siswa->nama_siswa }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    {{-- Penghargaan Card --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="p-4 sm:p-6">
                            {{-- Title --}}
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Penghargaan
                            </h3>

                            {{-- Penghargaan --}}
                            @if (isset($siswa->penghargaan) && count($siswa->penghargaan) > 0)
                                <ul class="mt-3 space-y-2">
                                    @foreach ($siswa->penghargaan as $penghargaan)
                                        <li class="flex items-start gap-2 text-sm text-gray-700">
                                            <i class="bi bi-award text-green-600 text-base"></i>
                                            <span>{{ $penghargaan->nama_penghargaan }} ({{ $penghargaan->tahun }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500 mt-3 italic">Belum ada data penghargaan</p>
                            @endif
                        </div>
                    </div>

                    {{-- SP Card --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden mt-4">
                        <div class="p-4 sm:p-6">
                            {{-- Title --}}
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                Surat Peringatan
                            </h3>

                            {{-- SP --}}
                            @if (isset($siswa->sp) && count($siswa->sp) > 0)
                                <ul class="mt-3 space-y-2">
                                    @foreach ($siswa->sp as $sp)
                                        <li class="flex items-start gap-2 text-sm text-gray-700">
                                            <i class="bi bi-exclamation-circle text-red-600 text-base"></i>
                                            <span>SP {{ $sp->tingkat }} - {{ $sp->keterangan }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500 mt-3 italic">Belum ada data SP</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>


            {{-- Student Information --}}
            <div class="xl:col-span-2 order-1 xl:order-2 space-y-4 lg:space-y-6">
                {{-- Personal Information Card --}}
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Informasi Siswa</h3>
                        <button
                            onclick="openEditModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}', '{{ $siswa->id_kelas }}')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-lg flex items-center gap-2 transition-colors text-sm sm:text-base">
                            <i class="bi bi-pencil-square"></i>
                            Edit
                        </button>
                    </div>
                    <div class="p-4 sm:p-6">
                        <div class="space-y-4">
                            @php
                                $studentInfo = [
                                    ['label' => 'NIS', 'value' => $siswa->nis],
                                    ['label' => 'Nama Lengkap', 'value' => $siswa->nama_siswa],
                                    ['label' => 'Kelas', 'value' => $siswa->kelas->nama_kelas],
                                    [
                                        'label' => 'Wali Kelas',
                                        'value' => $siswa->kelas->wali_kelas ?? 'Belum ditentukan',
                                    ],
                                    ['label' => 'Tahun Masuk', 'value' => $siswa->tahun_masuk ?? '2023'],
                                    ['label' => 'Status', 'value' => 'Aktif'],
                                ];
                            @endphp

                            @foreach ($studentInfo as $info)
                                <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                    <label
                                        class="text-xs sm:text-sm font-medium text-gray-500">{{ $info['label'] }}</label>
                                    <span
                                        class="text-sm sm:text-base text-gray-900 font-medium break-words text-right">{{ $info['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{-- Statistics Card --}}
<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center gap-2">
            <i class="bi bi-bar-chart text-blue-600"></i>
            Statistik Poin
        </h3>
    </div>
    <div class="p-4 sm:p-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @php
                $statistics = [
                    [
                        'icon' => 'bi-plus-circle-fill',
                        'label' => 'Poin Penghargaan',
                        'value' => $poinPositif ?? 0,
                        'bgColor' => 'from-green-50 to-emerald-50',
                        'borderColor' => 'border-green-200',
                        'iconBg' => 'bg-green-100',
                        'iconColor' => 'text-green-600',
                        'textColor' => 'text-green-600',
                        'valueColor' => 'text-green-700',
                    ],
                    [
                        'icon' => 'bi-dash-circle-fill',
                        'label' => 'Poin Pelanggaran',
                        'value' => $poinNegatif ?? 0,
                        'bgColor' => 'from-red-50 to-rose-50',
                        'borderColor' => 'border-red-200',
                        'iconBg' => 'bg-red-100',
                        'iconColor' => 'text-red-600',
                        'textColor' => 'text-red-600',
                        'valueColor' => 'text-red-700',
                    ],
                    [
                        'icon' => 'bi-calculator-fill',
                        'label' => 'Poin Total',
                        'value' => $poinTotal ?? 0,
                        'bgColor' => 'from-blue-50 to-indigo-50',
                        'borderColor' => 'border-blue-200',
                        'iconBg' => 'bg-blue-100',
                        'iconColor' => 'text-blue-600',
                        'textColor' => 'text-blue-600',
                        'valueColor' => 'text-blue-700',
                    ],
                ];
            @endphp

            @foreach ($statistics as $stat)
                <div class="bg-gradient-to-r {{ $stat['bgColor'] }} p-3 sm:p-4 rounded-lg border {{ $stat['borderColor'] }}">
                    <div class="text-center">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 {{ $stat['iconBg'] }} rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi {{ $stat['icon'] }} {{ $stat['iconColor'] }} text-lg sm:text-xl"></i>
                        </div>
                        <p class="{{ $stat['textColor'] }} text-xs sm:text-sm font-medium">{{ $stat['label'] }}</p>
                        <p class="text-xl sm:text-2xl font-bold {{ $stat['valueColor'] }}">{{ $stat['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


        {{-- Activities Card --}}
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                {{-- Judul --}}
                <h3 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-clock-history text-gray-700"></i>
                    Aktivitas Terakhir
                </h3>

                {{-- Tombol Export --}}
                <button
                    class="px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-100 transition flex items-center gap-2 text-sm font-medium text-gray-700 shadow-sm">
                    <i class="bi bi-download text-gray-600"></i>
                    Export
                </button>
            </div>

            <div class="p-4 sm:p-6">
                @if ($activities->count() > 0)
                    <div class="space-y-3">
                        @foreach ($activities as $activity)
                            @php
                                $isNegative = $activity->kategori === 'Pelanggaran';
                                $point = $isNegative ? "-{$activity->point}" : "+{$activity->point}";

                                $bgColor = $isNegative
                                    ? 'bg-red-50 border-red-200 hover:bg-red-100'
                                    : 'bg-green-50 border-green-200 hover:bg-green-100';

                                $titleColor = $isNegative ? 'text-red-800' : 'text-green-800';
                                $textColor = $isNegative ? 'text-red-700' : 'text-green-700';
                                $pointColor = $isNegative ? 'text-red-600' : 'text-green-600';
                            @endphp

                            <div
                                class="flex items-center justify-between p-3 rounded-lg border transition {{ $bgColor }}">
                                {{-- Kiri: Informasi --}}
                                <div class="flex-1 min-w-0">
                                    {{-- Judul --}}
                                    <p class="text-base font-bold break-words {{ $titleColor }}">
                                        {{ $activity->activity }}
                                    </p>
                                    {{-- Kategori --}}
                                    <p class="text-xs font-semibold {{ $textColor }}">
                                        {{ $activity->kategori }}
                                    </p>
                                    {{-- Uraian --}}
                                    <p class="text-sm break-words {{ $textColor }}">
                                        {{ $activity->description }}
                                    </p>
                                    {{-- Waktu --}}
                                    <p class="text-xs mt-1 text-gray-500">
                                        {{ $activity->created_at->format('Y-m-d') }}
                                    </p>
                                </div>

                                {{-- Kanan: Poin --}}
                                <div class="ml-3">
                                    <span class="text-base font-bold {{ $pointColor }}">
                                        {{ $point }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Belum ada aktivitas tercatat</p>
                @endif
            </div>

        </div>


        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 sm:pt-6 border-t border-gray-200">
            <button onclick="openDeleteModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors order-2 sm:order-1">
                <i class="bi bi-trash"></i>
                Hapus Siswa
            </button>
        </div>
    </div>

    @include('wakasek.siswa.edit')
    @include('wakasek.siswa.delete')
@endsection

@push('js')
    <script src="{{ asset('js/wakasek/siswa.js') }}"></script>
@endpush
