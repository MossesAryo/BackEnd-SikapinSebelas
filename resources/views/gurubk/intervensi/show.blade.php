@extends('layouts.gurubk.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/gurubk/siswa.css') }}">
@endpush

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Detail Intervensi</h1>

    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-700">Nama Siswa</h2>
            <p class="text-gray-600">{{ $intervensi->siswa->nama_siswa }} ({{ $intervensi->nis }})</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-700">Kelas</h2>
            <p class="text-gray-600">{{ $intervensi->siswa->kelas->nama_kelas ?? '-' }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-700">Nama Intervensi</h2>
            <p class="text-gray-600">{{ $intervensi->nama_intervensi }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-700">Tanggal Mulai Perbaikan</h2>
            <p class="text-gray-600">{{ $intervensi->tanggal_Mulai_Perbaikan }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-700">Tanggal Selesai Perbaikan</h2>
            <p class="text-gray-600">{{ $intervensi->tanggal_Selesai_Perbaikan }}</p>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-700">Status</h2>
            <span class="px-3 py-1 rounded-lg text-sm 
                {{ $intervensi->status == 'Selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ $intervensi->status }}
            </span>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-700">Dibuat Pada</h2>
            <p class="text-gray-600">{{ $intervensi->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="flex justify-end gap-2 pt-4">
        <a href="{{ route('intervensi.index') }}"
            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
            Kembali
        </a>
        {{-- <a href="{{ route('intervensi.edit', $intervensi->id) }}"
            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
            Edit
        </a> --}}
    </div>
</div>
@endsection
