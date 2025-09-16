@extends('layouts.wakasek.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/wakasek/siswa.css') }}">
@endpush

@section('content')
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-end gap-4">
            <!-- Header -->
            <div class="flex-1">
                <h1 class="text-2xl font-bold gradient-text">Detail Siswa</h1>
                <p class="mt-1 text-gray-600">Informasi lengkap data siswa</p>
            </div>

           
            <button onclick="opencatatanmodal('{{ $siswa->nis }}')"
                class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto 
              rounded-lg bg-blue-600 text-white transition-colors hover:bg-blue-700">
                <i class="bi bi-plus"></i>
                <span>Tambah Catatan Untuk BK</span>
            </button>
            

         
            <a href="{{ route('siswa.index') }}"
                class="flex items-center justify-center sm:justify-start gap-2 px-4 py-2 w-full sm:w-auto 
              rounded-lg bg-gray-600 text-white transition-colors hover:bg-gray-700">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>


       
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

        {{-- Main Content Layout --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            {{-- Left Sidebar: Profile & Activities --}}
            <div class="xl:col-span-1 space-y-6">
                {{-- Student Profile Card --}}
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="p-6">
                        {{-- Profile Picture --}}
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center">
                                    <i class="bi bi-person-fill text-4xl text-white"></i>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <i class="bi bi-check text-white text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Student Name --}}
                        <div class="text-center">
                            <h2 class="text-xl font-bold text-gray-900 break-words">
                                {{ $siswa->nama_siswa }}
                            </h2>
                        </div>
                    </div>
                </div>

                {{-- Awards Section --}}
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-award text-green-600"></i>
                            Penghargaan
                        </h3>
                        <button onclick="openpenghargaanModal('{{ $siswa->nis }}')"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                            <i class="bi bi-plus-circle"></i>
                            Tambah
                        </button>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @forelse ($penghargaanList as $item)
                                <li>
                                    <button type="button"
                                        onclick="openDeletePenghargaanModal('{{ $item->siswa->nis }}', '{{ $item->id }}', '{{ $item->penghargaan->alasan }}')"
                                        class="w-full flex items-start gap-3 p-3 rounded-lg border border-green-100 bg-green-50 hover:bg-green-100 transition">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-award-fill text-green-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p class="text-sm font-semibold text-green-800">
                                                {{ $item->penghargaan->level_penghargaan }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $item->penghargaan->alasan }} -
                                                {{ $item->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </button>
                                </li>
                            @empty
                                <li class="text-gray-500 text-sm italic">Belum ada data penghargaan</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- Warning Letters Section --}}
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-exclamation-triangle text-red-600"></i>
                            Surat Peringatan
                        </h3>
                        <button onclick="openperingatanModal('{{ $siswa->nis }}')"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                            <i class="bi bi-plus-circle"></i>
                            Tambah
                        </button>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @forelse ($peringatanList as $item)
                                <li>
                                    <button type="button"
                                        onclick="openDeletePeringatanModal('{{ $item->siswa->nis }}', '{{ $item->id }}', '{{ $item->peringatan->alasan }}')"
                                        class="w-full flex items-start gap-3 p-3 rounded-lg border border-red-100 bg-red-50 hover:bg-red-100 transition">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-file-earmark-text-fill text-red-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p class="text-sm font-semibold text-red-800">
                                                {{ $item->peringatan->level_sp }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $item->peringatan->alasan }} -
                                                {{ $item->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </button>
                                </li>
                            @empty
                                <li class="text-gray-500 text-sm italic">Belum ada surat peringatan</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Right Content: Student Information --}}
            <div class="xl:col-span-2 space-y-6">
                {{-- Student Information Card --}}
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Siswa</h3>
                        <button
                            onclick="openEditModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}', '{{ $siswa->id_kelas }}')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                            <i class="bi bi-pencil-square"></i>
                            Edit
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @php
                                $studentInfo = [
                                    ['label' => 'NIS', 'value' => $siswa->nis],
                                    ['label' => 'Nama Lengkap', 'value' => $siswa->nama_siswa],
                                    ['label' => 'Kelas', 'value' => $siswa->kelas->nama_kelas],
                                    ['label' => 'Tahun Masuk', 'value' => $siswa->tahun_masuk ?? '2023'],
                                ];
                            @endphp

                            @foreach ($studentInfo as $info)
                                <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                                    <span class="text-sm font-medium text-gray-500">{{ $info['label'] }}</span>
                                    <span
                                        class="text-base text-gray-900 font-medium break-words text-right">{{ $info['value'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Statistics Card --}}
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-bar-chart text-blue-600"></i>
                            Statistik Poin
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @php
                                $statistics = [
                                    [
                                        'icon' => 'bi-plus-circle-fill',
                                        'label' => 'Poin Penghargaan',
                                        'value' => $poinPositif ?? 0,
                                        'bgGradient' => 'from-green-50 to-emerald-50',
                                        'borderColor' => 'border-green-200',
                                        'iconBg' => 'bg-green-100',
                                        'iconColor' => 'text-green-600',
                                        'labelColor' => 'text-green-600',
                                        'valueColor' => 'text-green-700',
                                    ],
                                    [
                                        'icon' => 'bi-dash-circle-fill',
                                        'label' => 'Poin Pelanggaran',
                                        'value' => $poinNegatif ?? 0,
                                        'bgGradient' => 'from-red-50 to-rose-50',
                                        'borderColor' => 'border-red-200',
                                        'iconBg' => 'bg-red-100',
                                        'iconColor' => 'text-red-600',
                                        'labelColor' => 'text-red-600',
                                        'valueColor' => 'text-red-700',
                                    ],
                                    [
                                        'icon' => 'bi-calculator-fill',
                                        'label' => 'Poin Total',
                                        'value' => $poinTotal ?? 0,
                                        'bgGradient' => 'from-blue-50 to-indigo-50',
                                        'borderColor' => 'border-blue-200',
                                        'iconBg' => 'bg-blue-100',
                                        'iconColor' => 'text-blue-600',
                                        'labelColor' => 'text-blue-600',
                                        'valueColor' => 'text-blue-700',
                                    ],
                                ];
                            @endphp

                            @foreach ($statistics as $stat)
                                <div
                                    class="bg-gradient-to-r {{ $stat['bgGradient'] }} p-4 rounded-lg border {{ $stat['borderColor'] }}">
                                    <div class="text-center">
                                        <div
                                            class="w-12 h-12 {{ $stat['iconBg'] }} rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="bi {{ $stat['icon'] }} {{ $stat['iconColor'] }} text-xl"></i>
                                        </div>
                                        <p class="{{ $stat['labelColor'] }} text-sm font-medium mb-1">{{ $stat['label'] }}
                                        </p>
                                        <p class="text-2xl font-bold {{ $stat['valueColor'] }}">{{ $stat['value'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

               
                @if ($peringatanList->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <i class="bi bi-clipboard-check text-orange-600"></i>
                                Penanganan Siswa
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Penanganan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kesepakatan Waktu Perbaikan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Perubahan Setelah Perbaikan</th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    {{-- Dummy data for now --}}
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <p class="font-medium">Konseling Individual</p>
                                                <p class="text-gray-500">Sesi konseling dengan psikolog sekolah</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <p class="font-medium">2 Minggu</p>
                                                <p class="text-gray-500">15 Jan - 29 Jan 2024</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Membaik
                                                </span>
                                                <p class="text-gray-500 mt-1">Kedisiplinan meningkat, tidak ada pelanggaran
                                                    baru</p>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <p class="font-medium">Tugas Sosial</p>
                                                <p class="text-gray-500">Membantu membersihkan lingkungan sekolah</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <p class="font-medium">1 Minggu</p>
                                                <p class="text-gray-500">1 Feb - 7 Feb 2024</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Dalam Proses
                                                </span>
                                                <p class="text-gray-500 mt-1">Sedang menjalani tugas sosial dengan baik</p>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <p class="font-medium">Pembinaan Orang Tua</p>
                                                <p class="text-gray-500">Melibatkan orang tua dalam proses perbaikan</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <p class="font-medium">1 Bulan</p>
                                                <p class="text-gray-500">10 Feb - 10 Mar 2024</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Perlu Evaluasi
                                                </span>
                                                <p class="text-gray-500 mt-1">Masih ada kendala, perlu pendekatan lebih
                                                    intensif</p>
                                            </div>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- Recent Activities Card --}}
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-clock-history text-gray-700"></i>
                            Aktivitas Terakhir
                        </h3>
                        <button
                            class="px-4 py-2 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition flex items-center gap-2 text-sm font-medium text-gray-700 shadow-sm">
                            <i class="bi bi-download text-gray-600"></i>
                            Export
                        </button>
                    </div>
                    <div class="p-6">
                        @if ($activities->count() > 0)
                            <div class="space-y-4">
                                @foreach ($activities as $activity)
                                    @php
                                        $isViolation = $activity->kategori === 'Pelanggaran';
                                        $point = $isViolation ? "-{$activity->point}" : "+{$activity->point}";
                                        $cardClass = $isViolation
                                            ? 'bg-red-50 border-red-200 hover:bg-red-100'
                                            : 'bg-green-50 border-green-200 hover:bg-green-100';
                                        $titleClass = $isViolation ? 'text-red-800' : 'text-green-800';
                                        $textClass = $isViolation ? 'text-red-700' : 'text-green-700';
                                        $pointClass = $isViolation ? 'text-red-600' : 'text-green-600';
                                    @endphp

                                    <div
                                        class="flex items-center justify-between p-4 rounded-lg border transition {{ $cardClass }}">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-base font-bold break-words {{ $titleClass }} mb-1">
                                                {{ $activity->activity }}
                                            </h4>
                                            <p class="text-xs font-semibold {{ $textClass }} mb-1">
                                                {{ $activity->kategori }}
                                            </p>
                                            <p class="text-sm break-words {{ $textClass }} mb-2">
                                                {{ $activity->description }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $activity->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                        <div class="ml-4">
                                            <span class="text-lg font-bold {{ $pointClass }}">
                                                {{ $point }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="bi bi-calendar-x text-gray-400 text-4xl mb-3"></i>
                                <p class="text-gray-500 text-sm">Belum ada aktivitas tercatat</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <button onclick="openDeleteModal('{{ $siswa->nis }}', '{{ $siswa->nama_siswa }}')"
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="bi bi-trash"></i>
                Hapus Siswa
            </button>
        </div>
    </div>

    {{-- Included Modals --}}
    @include('wakasek.siswa.edit')
    @include('wakasek.siswa.delete')
    @include('wakasek.siswa.penghargaan')
    @include('wakasek.siswa.peringatan')
    @include('wakasek.siswa.catatan')
@endsection

@push('js')
    <script src="{{ asset('js/wakasek/siswa.js') }}"></script>
@endpush
