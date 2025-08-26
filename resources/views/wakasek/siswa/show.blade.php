@extends('layouts.app')

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
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 lg:gap-6">
            {{-- Student Profile Card --}}
            <div class="xl:col-span-1 order-2 xl:order-1">
                <div class="space-y-4 lg:space-y-6">
                    {{-- Profile Card --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="p-4 sm:p-6">
                            {{-- Student Photo --}}
                            <div class="flex justify-center mb-4 sm:mb-6">
                                <div class="relative">
                                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center">
                                        <i class="bi bi-person-fill text-2xl sm:text-4xl text-white"></i>
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 sm:w-8 sm:h-8 bg-green-500 rounded-full border-2 sm:border-4 border-white flex items-center justify-center">
                                        <i class="bi bi-check text-white text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Student Name --}}
                            <div class="text-center mb-4">
                                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-1 break-words">{{ $siswa->nama_siswa }}</h2>
                            </div>

                            {{-- Edit Button --}}
                            <button onclick="openEditModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}', '{{ $siswa->id_kelas }}')"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                        </div>
                    </div>

                    {{-- Quick Stats Card --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <i class="bi bi-speedometer2 text-indigo-600"></i>
                                Status Siswa
                            </h3>
                        </div>
                        <div class="p-4 sm:p-6 space-y-4">
                            {{-- Attendance Rate --}}
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Kehadiran</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="w-[92%] h-full bg-green-500 rounded-full"></div>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">92%</span>
                                </div>
                            </div>

                            {{-- Behavior Score --}}
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Perilaku</span>
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star-fill text-yellow-400 text-xs"></i>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Baik</span>
                                </div>
                            </div>

                            {{-- Academic Rank --}}
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Peringkat</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    #3 dari 32
                                </span>
                            </div>

                            {{-- Last Login --}}
                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <span class="text-xs text-gray-500">Terakhir aktif</span>
                                <span class="text-xs text-gray-700 font-medium">2 jam lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Student Information --}}
            <div class="xl:col-span-3 order-1 xl:order-2 space-y-4 lg:space-y-6">
                {{-- Row Layout untuk Desktop --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
                    {{-- Personal Information Card --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900">Informasi Siswa</h3>
                        </div>
                        <div class="p-4 sm:p-6">
                            <div class="space-y-4">
                                @php
                                    $studentInfo = [
                                        ['label' => 'NIS', 'value' => $siswa->nis],
                                        ['label' => 'Nama Lengkap', 'value' => $siswa->nama_siswa],
                                        ['label' => 'Kelas', 'value' => $siswa->kelas->nama_kelas],
                                        ['label' => 'Wali Kelas', 'value' => $siswa->kelas->wali_kelas ?? 'Belum ditentukan'],
                                        ['label' => 'Tahun Masuk', 'value' => $siswa->tahun_masuk ?? '2023'],
                                        ['label' => 'Status', 'value' => 'Aktif']
                                    ];
                                @endphp

                                @foreach($studentInfo as $info)
                                    <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                        <label class="text-xs sm:text-sm font-medium text-gray-500">{{ $info['label'] }}</label>
                                        <span class="text-sm sm:text-base text-gray-900 font-medium break-words text-right">{{ $info['value'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Riwayat Prestasi & Pelanggaran --}}
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <i class="bi bi-award text-yellow-600"></i>
                                Riwayat Prestasi & Pelanggaran
                            </h3>
                        </div>
                        <div class="p-4 sm:p-6">
                            <div class="space-y-3">
                                {{-- Prestasi --}}
                                <div class="space-y-2">
                                    <h4 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                        <i class="bi bi-trophy-fill text-yellow-500 text-xs"></i>
                                        Prestasi (3)
                                    </h4>
                                    <div class="space-y-2 ml-4">
                                        <div class="text-xs text-gray-600">• Juara 1 Olimpiade Matematika (2024)</div>
                                        <div class="text-xs text-gray-600">• Siswa Berprestasi Semester 1 (2024)</div>
                                        <div class="text-xs text-gray-600">• Juara 2 Lomba Karya Tulis (2023)</div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-3">
                                    <h4 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                        <i class="bi bi-exclamation-triangle-fill text-red-500 text-xs"></i>
                                        Pelanggaran (1)
                                    </h4>
                                    <div class="space-y-2 ml-4 mt-2">
                                        <div class="text-xs text-gray-600">• Terlambat masuk kelas (Sept 2024)</div>
                                    </div>
                                </div>

                                {{-- Progress Bar Perilaku --}}
                                <div class="border-t border-gray-100 pt-3">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-xs text-gray-600">Skor Perilaku</span>
                                        <span class="text-xs font-semibold text-green-600">Sangat Baik</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistics Card - Full Width --}}
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
                                        'label' => 'Poin Positif',
                                        'value' => $siswa->poin_positif ?? 0,
                                        'bgColor' => 'from-green-50 to-emerald-50',
                                        'borderColor' => 'border-green-200',
                                        'iconBg' => 'bg-green-100',
                                        'iconColor' => 'text-green-600',
                                        'textColor' => 'text-green-600',
                                        'valueColor' => 'text-green-700'
                                    ],
                                    [
                                        'icon' => 'bi-dash-circle-fill',
                                        'label' => 'Poin Negatif',
                                        'value' => $siswa->poin_negatif ?? 0,
                                        'bgColor' => 'from-red-50 to-rose-50',
                                        'borderColor' => 'border-red-200',
                                        'iconBg' => 'bg-red-100',
                                        'iconColor' => 'text-red-600',
                                        'textColor' => 'text-red-600',
                                        'valueColor' => 'text-red-700'
                                    ],
                                    [
                                        'icon' => 'bi-calculator-fill',
                                        'label' => 'Poin Total',
                                        'value' => $siswa->poin_total ?? 0,
                                        'bgColor' => 'from-blue-50 to-indigo-50',
                                        'borderColor' => 'border-blue-200',
                                        'iconBg' => 'bg-blue-100',
                                        'iconColor' => 'text-blue-600',
                                        'textColor' => 'text-blue-600',
                                        'valueColor' => 'text-blue-700'
                                    ]
                                ];
                            @endphp

                            @foreach($statistics as $stat)
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

                {{-- Activities Card - Full Width --}}
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-clock-history text-blue-600"></i>
                            Aktivitas Terakhir
                        </h3>
                    </div>
                    <div class="p-4 sm:p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-3">
                            @php
                                $activities = [
                                    [
                                        'title' => 'Prestasi Akademik',
                                        'description' => 'Mendapat peringkat 1 di kelas',
                                        'bgColor' => 'bg-blue-50',
                                        'borderColor' => 'border-blue-200',
                                        'dotColor' => 'bg-blue-500',
                                        'titleColor' => 'text-blue-800',
                                        'descColor' => 'text-blue-600',
                                        'time' => '2 hari lalu'
                                    ],
                                    [
                                        'title' => 'Kegiatan Ekstrakurikuler',
                                        'description' => 'Mengikuti kegiatan pramuka',
                                        'bgColor' => 'bg-purple-50',
                                        'borderColor' => 'border-purple-200',
                                        'dotColor' => 'bg-purple-500',
                                        'titleColor' => 'text-purple-800',
                                        'descColor' => 'text-purple-600',
                                        'time' => '5 hari lalu'
                                    ],
                                    [
                                        'title' => 'Prestasi Akademik',
                                        'description' => 'Juara olimpiade matematika',
                                        'bgColor' => 'bg-blue-50',
                                        'borderColor' => 'border-blue-200',
                                        'dotColor' => 'bg-blue-500',
                                        'titleColor' => 'text-blue-800',
                                        'descColor' => 'text-blue-600',
                                        'time' => '1 minggu lalu'
                                    ]
                                ];
                            @endphp

                            @foreach($activities as $activity)
                                <div class="flex items-start gap-3 p-3 {{ $activity['bgColor'] }} rounded-lg border {{ $activity['borderColor'] }}">
                                    <div class="w-2 h-2 {{ $activity['dotColor'] }} rounded-full flex-shrink-0 mt-2"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs sm:text-sm font-medium {{ $activity['titleColor'] }} break-words">{{ $activity['title'] }}</p>
                                        <p class="text-xs {{ $activity['descColor'] }} break-words mb-1">{{ $activity['description'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 sm:pt-6 border-t border-gray-200">
            <button onclick="openDeleteModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors order-2 sm:order-1">
                <i class="bi bi-trash"></i>
                Hapus Siswa
            </button>
            <button onclick="window.print()"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors order-1 sm:order-2">
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