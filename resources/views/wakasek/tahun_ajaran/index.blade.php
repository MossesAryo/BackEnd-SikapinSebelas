@extends('layouts.wakasek.app')

@php
    $preview = $preview ?? ['x_ke_xi' => 0, 'xi_ke_xii' => 0, 'lulus' => 0];
    $tahunAktif = $tahunAktif ?? null;
    $tahunDipilih = old('tahun_ajaran_id', $tahunAktif?->id);
@endphp

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold">Manajemen Tahun Ajaran</h1>
        <p class="text-gray-500">Kelola proses kenaikan kelas siswa sesuai tahun ajaran aktif</p>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Preview --}}
    <div class="grid md:grid-cols-3 gap-4">
        <div class="bg-blue-50 border rounded-lg p-4">
            <p class="text-sm text-gray-600">Siswa X → XI</p>
            <p class="text-3xl font-bold text-blue-700">{{ $preview['x_ke_xi'] }}</p>
        </div>
        <div class="bg-indigo-50 border rounded-lg p-4">
            <p class="text-sm text-gray-600">Siswa XI → XII</p>
            <p class="text-3xl font-bold text-indigo-700">{{ $preview['xi_ke_xii'] }}</p>
        </div>
        <div class="bg-green-50 border rounded-lg p-4">
            <p class="text-sm text-gray-600">Siswa XII → Alumni</p>
            <p class="text-3xl font-bold text-green-700">{{ $preview['lulus'] }}</p>
        </div>
    </div>

    {{-- Form --}}
    <div class="bg-white border rounded-xl p-6">
        <h3 class="font-semibold mb-1 text-lg">Pilih Tahun Ajaran</h3>
        <p class="text-sm text-gray-500 mb-4">
            Sistem akan otomatis menaikkan atau menurunkan kelas siswa sesuai selisih tahun ajaran.
        </p>

        <form method="POST" action="{{ route('tahun_ajaran.update') }}"
              onsubmit="return confirmGanti(event)">
            @csrf
            <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
                <select name="tahun_ajaran_id" id="selectTahun"
                        class="border rounded px-4 py-2 w-full md:w-1/2">
                    @foreach ($tahunAjaran as $ta)
                        <option value="{{ $ta->id }}"
                            data-selisih="{{ $ta->id - ($tahunAktif?->id ?? $ta->id) }}"
                            {{ $ta->id == $tahunDipilih ? 'selected' : '' }}>
                            {{ $ta->tahun_ajaran }}
                            @if ($ta->status === 'aktif') (aktif) @endif
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold">
                    Ganti Tahun Ajaran
                </button>
            </div>

            <p id="hintSelisih" class="text-sm mt-3"></p>
        </form>
    </div>

</div>

{{-- Modal --}}
<div id="modalKonfirmasi"
     class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50 flex">
    <div class="bg-white rounded-xl w-full max-w-md shadow-lg">
        <div class="p-5 border-b">
            <h3 class="font-semibold text-lg">Konfirmasi Ganti Tahun Ajaran</h3>
        </div>
        <div class="p-5 text-sm space-y-2">
            <p id="modalDesc" class="text-gray-700"></p>
            <p class="text-red-600 font-semibold mt-2">Proses ini tidak bisa dibatalkan.</p>
        </div>
        <div class="p-5 border-t flex justify-end gap-2">
            <button onclick="closeModal()"
                    class="border px-4 py-2 rounded hover:bg-gray-50">
                Batal
            </button>
            <button id="btnConfirm"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Ya, Ganti
            </button>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    const select   = document.getElementById('selectTahun');
    const hint     = document.getElementById('hintSelisih');
    const activeId = {{ $tahunAktif?->id ?? 'null' }};

    function hitungPerubahan(selisih) {
        const tingkats = ['X', 'XI', 'XII'];
        return tingkats.map(t => {
            const targetIdx = tingkats.indexOf(t) + selisih;
            if (selisih > 0) {
                return targetIdx >= tingkats.length
                    ? `${t} → Alumni`
                    : `${t} → ${tingkats[targetIdx]}`;
            } else {
                return targetIdx < 0
                    ? `${t} → (tidak berubah)`
                    : `${t} → ${tingkats[targetIdx]}`;
            }
        }).join(', ');
    }

    function updateHint() {
        const opt     = select.options[select.selectedIndex];
        const selisih = parseInt(opt.dataset.selisih ?? 0);

        if (!activeId || selisih === 0) {
            hint.textContent = '';
            hint.className   = 'text-sm mt-3';
            return;
        }

        if (selisih > 0) {
            hint.textContent = `⬆ Naik ${selisih} tingkat: ${hitungPerubahan(selisih)}`;
            hint.className   = 'text-sm text-green-700 mt-3';
        } else {
            hint.textContent = `⬇ Turun ${Math.abs(selisih)} tingkat: ${hitungPerubahan(selisih)}`;
            hint.className   = 'text-sm text-yellow-600 mt-3';
        }
    }

    select.addEventListener('change', updateHint);
    updateHint();

    function confirmGanti(e) {
        e.preventDefault();

        const opt     = select.options[select.selectedIndex];
        const selisih = parseInt(opt.dataset.selisih ?? 0);

        if (selisih === 0) {
            alert('Tahun ajaran ini sudah aktif.');
            return false;
        }

        const arah   = selisih > 0
            ? `Naik ${selisih} tingkat`
            : `Turun ${Math.abs(selisih)} tingkat`;

        document.getElementById('modalDesc').textContent = `${arah}: ${hitungPerubahan(selisih)}`;
        document.getElementById('modalKonfirmasi').classList.remove('hidden');
        document.getElementById('btnConfirm').onclick = () => e.target.submit();

        return false;
    }

    function closeModal() {
        document.getElementById('modalKonfirmasi').classList.add('hidden');
    }
</script>
@endpush