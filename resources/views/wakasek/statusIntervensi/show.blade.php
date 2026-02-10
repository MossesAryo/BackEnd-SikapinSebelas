@extends('layouts.wakasek.app')

@section('content')
<div class="w-full px-4 py-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-visible">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-5 sm:px-6 lg:px-8 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-white">Status Penanganan</h3>
                    <p class="text-blue-100 text-sm">Tracking progress siswa</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-white/20 text-white text-sm font-medium px-3 py-1 rounded-lg">
                        ID: {{ $intervensi->id_intervensi }}
                    </span>
                    <!-- WARNA STATUS DISESUAIKAN DENGAN TABEL PENANGANAN -->
                    <span class="px-4 py-2 rounded-full text-xs font-bold
                        @if($intervensi->status === 'Selesai') bg-green-100 text-green-800
                        @elseif($intervensi->status === 'Dalam Binaan') bg-yellow-100 text-yellow-800
                        @elseif($intervensi->status === 'Binaan Khusus') bg-orange-100 text-orange-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ $intervensi->status }}
                    </span>
                </div>
            </div>

            <!-- Timeline -->
            <div class="p-6 relative">
                <!-- Vertical line -->
                <div class="absolute left-[11px] top-3 bottom-3 w-0.5 bg-gradient-to-b from-green-500 via-blue-500 to-gray-300"></div>

                @php
                    $status = $intervensi->status;
                    function stepClass($current, $status) {
                        $order = ['Intervensi Dibuat', 'Dalam Binaan', 'Binaan Khusus', 'Selesai'];
                        $currIndex = array_search($current, $order);
                        $statusIndex = array_search($status, $order);
                        if ($currIndex < $statusIndex) return 'done';
                        if ($currIndex === $statusIndex) return 'active';
                        return 'pending';
                    }
                @endphp

                <!-- Step 1: Intervensi Dibuat -->
                @php $step = stepClass('Intervensi Dibuat', $status); @endphp
                <div class="relative flex items-start group mb-6">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        {{ $step === 'done' || $step === 'active' ? 'bg-green-500 ring-4 ring-green-100' : 'bg-gray-300 ring-4 ring-gray-100' }} flex-shrink-0">
                        <i class="bi bi-check-lg text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        {{ $step === 'done' || $step === 'active' ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200 opacity-70' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-green-700">Penanganan Dibuat</p>
                                <p class="text-gray-600 text-sm mt-1">Data Penanganan telah ditambahkan</p>
                            </div>
                            <span class="{{ $step === 'done' || $step === 'active' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600' }} text-xs px-3 py-1 rounded-full">
                                {{ $step === 'active' ? 'Aktif' : ($step === 'done' ? 'Selesai' : 'Belum') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Dalam Bimbingan -->
                @php $step = stepClass('Dalam Binaan', $status); @endphp
                <div class="relative flex items-start group mb-6">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        {{ $step === 'done' || $step === 'active' ? 'bg-yellow-500 ring-4 ring-yellow-100' : 'bg-gray-300 ring-4 ring-gray-100' }} flex-shrink-0">
                        <i class="bi bi-person-hearts text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        {{ $step === 'done' || $step === 'active' ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200 opacity-70' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-yellow-700">Dalam Binaan</p>
                                <p class="text-gray-600 text-sm mt-1">Siswa sedang dibimbing secara aktif</p>
                            </div>
                            <span class="{{ $step === 'done' || $step === 'active' ? 'bg-yellow-500 text-white' : 'bg-gray-300 text-gray-600' }} text-xs px-3 py-1 rounded-full">
                                {{ $step === 'active' ? 'Aktif' : ($step === 'done' ? 'Selesai' : 'Belum') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Dalam Pemantauan -->
                @php $step = stepClass('Binaan Khusus', $status); @endphp
                <div class="relative flex items-start group mb-6">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        {{ $step === 'done' || $step === 'active' ? 'bg-orange-500 ring-4 ring-orange-100' : 'bg-gray-300 ring-4 ring-gray-100' }} flex-shrink-0">
                        <i class="bi bi-eye text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        {{ $step === 'done' || $step === 'active' ? 'bg-orange-50 border-orange-200' : 'bg-gray-50 border-gray-200 opacity-70' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-orange-700">Binaan Khusus</p>
                                <p class="text-gray-600 text-sm mt-1">Siswa sedang dibimbing secara Khusus</p>
                            </div>
                            <span class="{{ $step === 'done' || $step === 'active' ? 'bg-orange-500 text-white' : 'bg-gray-300 text-gray-600' }} text-xs px-3 py-1 rounded-full">
                                {{ $step === 'active' ? 'Aktif' : ($step === 'done' ? 'Selesai' : 'Belum') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Selesai -->
                @php $step = stepClass('Selesai', $status); @endphp
                <div class="relative flex items-start group">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        {{ $step === 'done' || $step === 'active' ? 'bg-green-600 ring-4 ring-green-200' : 'bg-gray-300 ring-4 ring-gray-100' }} flex-shrink-0">
                        <i class="bi bi-trophy text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        {{ $step === 'done' || $step === 'active' ? 'bg-green-100 border-green-300' : 'bg-gray-50 border-gray-200 opacity-70' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-green-700">Selesai</p>
                                <p class="text-green-600 text-sm mt-1">Seluruh proses intervensi telah selesai</p>
                                @if($intervensi->perubahan_setelah_intervensi)
                                    <p class="text-green-600 text-sm mt-2 font-medium">Perubahan Setelah Intervensi:</p>
                                    <p class="text-gray-700 italic bg-green-50 p-3 rounded-lg mt-1">
                                        "{{ $intervensi->perubahan_setelah_intervensi }}"
                                    </p>
                                @endif
                            </div>
                            <span class="{{ $step === 'done' || $step === 'active' ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-600' }} text-xs px-3 py-1 rounded-full">
                                {{ $step === 'active' ? 'Aktif' : ($step === 'done' ? 'Selesai' : 'Belum') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="border-t bg-white">
                <div class="max-w-5xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center sm:justify-between gap-3">
                    <p class="text-sm text-gray-500">Dibuat pada: <span class="font-medium text-gray-700">{{ $intervensi->created_at->format('d M Y H:i') }}</span></p>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('statusintervensi.index') }}"
                           class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                            Kembali
                        </a>

                        {{-- Uncomment/edit next line to show an Edit button in the footer --}}
                        {{-- <a href="{{ route('intervensi.edit', $intervensi->id) }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Edit</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection