@extends('layouts.wakasek.app')

@section('content')
<div class="w-full px-4 py-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-5 sm:px-6 lg:px-8 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-white">Status Intervensi</h3>
                    <p class="text-blue-100 text-sm">Tracking progress siswa</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-white/20 text-white text-sm font-medium px-3 py-1 rounded-lg">
                        ID: {{ $intervensi->id_intervensi }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($intervensi->status === 'Dalam Bimbingan') bg-blue-100 text-blue-700
                        @elseif($intervensi->status === 'Dalam Pemantauan') bg-yellow-100 text-yellow-700
                        @elseif($intervensi->status === 'Selesai') bg-green-100 text-green-700
                        @else bg-gray-100 text-gray-700 @endif">
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
                        $order = ['Intervensi Dibuat', 'Dalam Bimbingan', 'Dalam Pemantauan', 'Selesai'];
                        $currIndex = array_search($current, $order);
                        $statusIndex = array_search($status, $order);

                        if ($currIndex < $statusIndex) return 'done';
                        if ($currIndex === $statusIndex) return 'active';
                        return 'pending';
                    }
                @endphp

                <!-- Step 1 -->
                @php $step = stepClass('Intervensi Dibuat', $status); @endphp
                <div class="relative flex items-start group mb-6">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        @if($step === 'done') bg-green-500 ring-4 ring-green-100
                        @elseif($step === 'active') bg-green-500 ring-4 ring-green-200 animate-pulse
                        @else bg-gray-300 ring-4 ring-gray-100 @endif flex-shrink-0">
                        <i class="bi bi-check-lg text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        @if($step === 'done') bg-green-50 border-green-200
                        @elseif($step === 'active') bg-green-100 border-green-300
                        @else bg-gray-50 border-gray-200 opacity-70 @endif">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-green-700">Intervensi Dibuat</p>
                                <p class="text-gray-600 text-sm mt-1">Data intervensi telah ditambahkan</p>
                            </div>
                            @if($step === 'done')
                                <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full">Selesai</span>
                            @elseif($step === 'active')
                                <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="bg-gray-300 text-gray-600 text-xs px-3 py-1 rounded-full">Belum</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                @php $step = stepClass('Dalam Bimbingan', $status); @endphp
                <div class="relative flex items-start group mb-6">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        @if($step === 'done') bg-blue-500 ring-4 ring-blue-100
                        @elseif($step === 'active') bg-blue-500 ring-4 ring-blue-200 animate-pulse
                        @else bg-gray-300 ring-4 ring-gray-100 @endif flex-shrink-0">
                        <i class="bi bi-person-hearts text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        @if($step === 'done') bg-blue-50 border-blue-200
                        @elseif($step === 'active') bg-blue-100 border-blue-300
                        @else bg-gray-50 border-gray-200 opacity-70 @endif">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-blue-700">Dalam Bimbingan</p>
                                <p class="text-gray-600 text-sm mt-1">Siswa sedang dibimbing secara aktif</p>
                            </div>
                            @if($step === 'done')
                                <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Selesai</span>
                            @elseif($step === 'active')
                                <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="bg-gray-300 text-gray-600 text-xs px-3 py-1 rounded-full">Belum</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                @php $step = stepClass('Dalam Pemantauan', $status); @endphp
                <div class="relative flex items-start group mb-6">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        @if($step === 'done') bg-yellow-400 ring-4 ring-yellow-100
                        @elseif($step === 'active') bg-yellow-400 ring-4 ring-yellow-200 animate-pulse
                        @else bg-gray-300 ring-4 ring-gray-100 @endif flex-shrink-0">
                        <i class="bi bi-eye text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        @if($step === 'done') bg-yellow-50 border-yellow-200
                        @elseif($step === 'active') bg-yellow-100 border-yellow-300
                        @else bg-gray-50 border-gray-200 opacity-70 @endif">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-yellow-700">Dalam Pemantauan</p>
                                <p class="text-gray-600 text-sm mt-1">Perkembangan siswa sedang dipantau</p>
                            </div>
                            @if($step === 'done')
                                <span class="bg-yellow-400 text-gray-800 text-xs px-3 py-1 rounded-full">Selesai</span>
                            @elseif($step === 'active')
                                <span class="bg-yellow-400 text-gray-800 text-xs px-3 py-1 rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-gray-800 rounded-full mr-1.5 animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="bg-gray-300 text-gray-600 text-xs px-3 py-1 rounded-full">Belum</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                @php $step = stepClass('Selesai', $status); @endphp
                <div class="relative flex items-start group">
                    <div class="absolute left-0 w-6 h-6 flex items-center justify-center rounded-full 
                        @if($step === 'done' || $step === 'active') bg-green-400 ring-4 ring-green-200
                        @else bg-green-300 ring-4 ring-green-100 @endif flex-shrink-0">
                        <i class="bi bi-check-circle text-white text-sm"></i>
                    </div>
                    <div class="ml-10 flex-1 rounded-xl p-4 border transition-all
                        @if($step === 'done' || $step === 'active') bg-green-100 border-green-300
                        @else bg-green-50 border-green-200 opacity-70 @endif">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-green-700">Selesai</p>
                                <p class="text-green-600 text-sm mt-1">Seluruh proses intervensi telah selesai</p>
                                <p class="text-green-600 text-sm mt-1">Perubahan Setelah Intervensi :</p>
                                <p class="text-gray-600 text-sm mt-1 italic">"{{ $intervensi->perubahan_setelah_intervensi }}"</p>
                                
                            </div>
                            @if($step === 'done')
                                <span class="bg-green-400 text-white text-xs px-3 py-1 rounded-full">Selesai</span>
                            @elseif($step === 'active')
                                <span class="bg-green-400 text-white text-xs px-3 py-1 rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="bg-green-300 text-green-600 text-xs px-3 py-1 rounded-full">Belum</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
