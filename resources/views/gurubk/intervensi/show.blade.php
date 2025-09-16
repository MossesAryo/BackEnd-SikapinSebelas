@extends('layouts.gurubk.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/gurubk/siswa.css') }}">
@endpush

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <!-- Header -->
<div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl shadow-lg p-6 mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold">Detail Intervensi</h1>
        <p class="text-sm text-blue-100">Informasi lengkap mengenai intervensi siswa</p>
    </div>

    <!-- Tombol Edit (pakai modal) -->
    <button
        onclick="openEditModal(
            '{{ $intervensi->id_intervensi }}',
            '{{ $intervensi->nis }}',
            '{{ $intervensi->nama_intervensi }}',
            '{{ $intervensi->isi_intervensi }}',
            '{{ $intervensi->status }}',
            '{{ $intervensi->tanggal_Mulai_Perbaikan }}',
            '{{ $intervensi->tanggal_Selesai_Perbaikan }}',
            '{{ $intervensi->perubahan_setelah_intervensi ?? '' }}'
        )"
        class="flex items-center gap-2 px-4 py-2 bg-white text-blue-600 font-medium rounded-lg shadow hover:bg-gray-100 transition"
    >
        <i class="bi bi-pencil-square text-sm"></i>
        Edit
    </button>
</div>


        <!-- Card Utama -->
        <div class="bg-white shadow-md rounded-xl p-6 space-y-6">
            <!-- Info Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Nama Siswa</h2>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $intervensi->siswa->nama_siswa }} ({{ $intervensi->nis }})
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500">Kelas</h2>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $intervensi->siswa->kelas->nama_kelas ?? '-' }}
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500">Tanggal Mulai Perbaikan</h2>
                    <p class="text-gray-700">
                        {{ $intervensi->tanggal_Mulai_Perbaikan ?? '-' }}
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-500">Tanggal Selesai Perbaikan</h2>
                    <p class="text-gray-700">
                        {{ $intervensi->tanggal_Selesai_Perbaikan ?? '-' }}
                    </p>
                </div>
            </div>

            <!-- Intervensi -->
            <div class="space-y-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Nama Intervensi</h2>
                    <p class="text-gray-600">{{ $intervensi->nama_intervensi }}</p>
                </div>

                <div>
    <h2 class="text-lg font-semibold text-gray-700">Isi Intervensi</h2>
    <div class="mt-2 px-3 py-2 border border-gray-200 rounded-md text-gray-800 leading-relaxed">
        {{ $intervensi->isi_intervensi }}
    </div>
</div>

<div>
    <h2 class="text-lg font-semibold text-gray-700">Perubahan Setelah Intervensi</h2>
    <div class="mt-2 px-3 py-2 border border-green-200 rounded-md bg-green-50 text-gray-800 leading-relaxed">
        {{ $intervensi->perubahan_setelah_intervensi ?? '-' }}
    </div>
</div>


            </div>

            <!-- Status -->
            <div class="flex items-center gap-2">
                <h2 class="text-lg font-semibold text-gray-700">Status:</h2>
                <span
                    class="px-3 py-1 rounded-full text-sm font-medium
                        @if ($intervensi->status == 'Selesai') bg-green-100 text-green-700
                        @elseif($intervensi->status == 'Dalam Bimbingan') bg-blue-100 text-blue-700
                        @elseif($intervensi->status == 'Dalam Pemantauan') bg-yellow-100 text-yellow-700
                        @else bg-gray-100 text-gray-700 @endif">
                    {{ $intervensi->status }}
                </span>
            </div>

            <!-- Footer -->
            <div class="flex justify-between items-center pt-6 border-t">
                <p class="text-sm text-gray-500">Dibuat pada: {{ $intervensi->created_at->format('d M Y H:i') }}</p>

                <div class="flex gap-2">
                    <a href="{{ route('intervensi.index') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                        Kembali
                    </a>
                    {{-- Kalau mau tombol edit tinggal aktifkan --}}
                    {{-- <a href="{{ route('intervensi.edit', $intervensi->id) }}"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Edit
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    @include('gurubk.intervensi.edit')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        

        function openEditModal(id_intervensi, nis, nama_intervensi, isi_intervensi, status, tanggal_Mulai_Perbaikan,
            tanggal_Selesai_Perbaikan, perubahan_setelah_intervensi) {
            document.getElementById('nis_edit').value = nis;
            document.getElementById('nama_intervensi_edit').value = nama_intervensi;
            document.getElementById('isi_intervensi_edit').value = isi_intervensi;
            document.getElementById('status_edit').value = status;
            document.getElementById('tanggal_Mulai_Perbaikan_edit').value = tanggal_Mulai_Perbaikan;
            document.getElementById('tanggal_Selesai_Perbaikan_edit').value = tanggal_Selesai_Perbaikan;
            document.getElementById('perubahan_setelah_intervensi_edit').value = perubahan_setelah_intervensi||'';

            togglePerubahanFieldEdit();

            document.getElementById('form-edit').action = `/intervensi/${id_intervensi}/update`;
            openModal('modal-edit');
        }

        function togglePerubahanFieldEdit() {
            const status = document.getElementById('status_edit').value;
            const perubahanField = document.getElementById('perubahan-field-edit');
            const perubahanTextarea = document.getElementById('perubahan_setelah_intervensi_edit');

            if (status === 'Selesai') {
                perubahanField.classList.remove('hidden');
                perubahanTextarea.setAttribute('required', 'required');
            } else {
                perubahanField.classList.add('hidden');
                perubahanTextarea.removeAttribute('required');
                perubahanTextarea.value = '';
            }
        }

        


        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter', 'modal-penghargaan', 'modal-peringatan',
                'modal-delete-penghargaan', 'modal-delete-peringatan', 'modal-catatan'
            ].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter', 'modal-penghargaan',
                    'modal-peringatan', 'modal-delete-penghargaan', 'modal-delete-peringatan', 'modal-catatan'
                ].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
    </script>
@endsection
