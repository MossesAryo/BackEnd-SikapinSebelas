@extends('layouts.wakasek.app')

@section('content')

    <div class="space-y-6">

        <!-- Profile Section -->
        <div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-8">

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl p-8 shadow-sm text-center h-full">

                <!-- Profile Icon -->
                <div
                    class="w-[100px] h-[100px] bg-slate-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-6 text-slate-500 border-3 border-slate-200">
                    <i class="bi bi-person"></i>
                </div>

                <!-- Profile Name -->
                <h1 class="profile-name text-2xl font-semibold text-slate-800 mb-2">
                    @if (auth()->user()->role == 2)
                        {{ Auth::user()->gurubk->nama_guru_bk }}
                    @elseif (auth()->user()->role == 1)
                        {{ Auth::user()->wakasek->nama_wakasek }}
                    @elseif (auth()->user()->role == 4)
                        {{ Auth::user()->ketua_program->nama_ketua_program }}
                    @elseif (auth()->user()->role == 3)
                        {{ Auth::user()->walikelas->nama_walikelas }}
                    @endif
                </h1>

                <!-- Profile Title -->
                @if (auth()->user()->role == 2)
                    <p class="profile-title text-blue-600 font-medium mb-6 text-sm">
                        Guru BK
                    </p>
                @elseif (auth()->user()->role == 1)
                    <p class="profile-title text-blue-600 font-medium mb-6 text-sm">
                        Wakil Kepala Kesiswaan
                    </p>
                @elseif (auth()->user()->role == 4)
                    <p class="profile-title text-blue-600 font-medium mb-6 text-sm">
                        Ketua Program
                    </p>
                @elseif (auth()->user()->role == 3)
                    <p class="profile-title text-blue-600 font-medium mb-6 text-sm">
                        Wali Kelas
                    </p>
                @endif

                <!-- Logout -->
                <div class="flex flex-col gap-3">

                    <form method="POST" action="#" class="w-full">
                        @csrf

                        <a href="{{ route('logout') }}"
                            class="flex items-center justify-center px-4 py-3 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors w-full btn-animate">

                            <i class="bi bi-box-arrow-right mr-2"></i>
                            Logout

                        </a>
                    </form>

                </div>

            </div>


            <!-- Informasi Profile -->
            <div class="bg-white rounded-2xl p-8 shadow-sm h-full">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">

                    <h2
                        class="text-xl font-semibold text-slate-800 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-[30px] after:h-0.5 after:bg-blue-600 after:rounded-sm">
                        Informasi Profil
                    </h2>

                    <!-- Edit Button -->
                    @if (auth()->user()->role == 1)
                        <button
                            type="button"
                            onclick="openModal()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg flex items-center gap-2 transition-colors font-medium">

                            <i class="bi bi-pencil-square"></i>
                            Edit Profil

                        </button>
                    @endif

                </div>


                <!-- Profile Information -->
                <div class="space-y-4">

                    <!-- Nama Lengkap -->
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">

                        <div class="text-sm font-medium text-slate-500">
                            Nama Lengkap
                        </div>

                        <div class="info-value text-sm font-medium text-slate-800">

                            @if (auth()->user()->role == 2)
                                {{ Auth::user()->gurubk->nama_guru_bk }}
                            @elseif (auth()->user()->role == 1)
                                {{ Auth::user()->wakasek->nama_wakasek }}
                            @elseif (auth()->user()->role == 4)
                                {{ Auth::user()->ketua_program->nama_ketua_program }}
                            @elseif (auth()->user()->role == 3)
                                {{ Auth::user()->walikelas->nama_walikelas }}
                            @endif

                        </div>

                    </div>


                    <!-- NIP -->
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">

                        <div class="text-sm font-medium text-slate-500">
                            NIP
                        </div>

                        <div class="info-value text-sm font-medium text-slate-800">

                            @if (auth()->user()->role == 2)
                                {{ Auth::user()->gurubk->nip_bk }}
                            @elseif (auth()->user()->role == 1)
                                {{ Auth::user()->wakasek->nip_wakasek }}
                            @elseif (auth()->user()->role == 4)
                                {{ Auth::user()->ketua_program->nip_kaprog }}
                            @elseif (auth()->user()->role == 3)
                                {{ Auth::user()->walikelas->nip_walikelas }}
                            @endif

                        </div>

                    </div>


                    <!-- Email -->
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">

                        <div class="text-sm font-medium text-slate-500">
                            Email
                        </div>

                        <div class="info-value text-sm font-medium text-slate-800">
                            {{ Auth::user()->email }}
                        </div>

                    </div>


                    <!-- Jabatan -->
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">

                        <div class="text-sm font-medium text-slate-500">
                            Jabatan
                        </div>

                        <div class="info-value text-sm font-medium text-slate-800">

                            @if (auth()->user()->role == 2)
                                Guru Bimbingan Konseling
                            @elseif (auth()->user()->role == 1)
                                Wakil Kepala Kesiswaan
                            @elseif (auth()->user()->role == 4)
                                Ketua Program
                            @elseif (auth()->user()->role == 3)
                                Wali Kelas
                            @endif

                        </div>

                    </div>


                    <!-- Jurusan -->
                    @if (auth()->user()->role == 4)

                        <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">

                            <div class="text-sm font-medium text-slate-500">
                                Jurusan
                            </div>

                            <div class="info-value text-sm font-medium text-slate-800">
                                {{ Auth::user()->ketua_program->jurusan->nama_jurusan }}
                            </div>

                        </div>

                    @endif


                    <!-- Kelas -->
                    @if (auth()->user()->role == 3)

                        <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">

                            <div class="text-sm font-medium text-slate-500">
                                Wali Kelas
                            </div>

                            <div class="info-value text-sm font-medium text-slate-800">
                                {{ Auth::user()->walikelas->id_kelas }}
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- ================================================== -->
    <!-- MODAL EDIT PROFILE -->
    <!-- ================================================== -->

    @if (auth()->user()->role == 1)

        <div
            id="editModal"
            class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">

            <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden">

                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                    class="p-6 space-y-5">

                    @csrf
                    @method('PUT')

                    <!-- Modal Header -->
                    <div class="flex justify-between items-center border-b pb-4">

                        <h2 class="text-2xl font-bold text-gray-800">
                            Edit Profil
                        </h2>

                        <button
                            type="button"
                            onclick="closeModal()"
                            class="text-gray-400 hover:text-gray-600 text-3xl leading-none">

                            &times;

                        </button>

                    </div>


                    <!-- Form Fields -->
                    <div class="space-y-5">

                        <!-- Nama Wakasek -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="nama_wakasek"
                                value="{{ auth()->user()->wakasek->nama_wakasek ?? '' }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @error('nama_wakasek')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- NIP Wakasek -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                NIP
                            </label>

                            <input
                                type="text"
                                name="nip_wakasek"
                                value="{{ auth()->user()->wakasek->nip_wakasek ?? '' }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @error('nip_wakasek')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Email -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ auth()->user()->email }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @error('email')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-3 pt-5 border-t">

                        <button
                            type="button"
                            onclick="closeModal()"
                            class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">

                            Batal

                        </button>

                        <button
                            type="submit"
                            class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-medium transition">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif

@endsection


@push('css')

<style>

    .btn-animate:active {
        transform: scale(0.98);
    }

</style>

@endpush


@push('js')

<script>

    // Open Modal
    function openModal() {
        const modal = document.getElementById('editModal');

        if (modal) {
            modal.classList.remove('hidden');
        }
    }


    // Close Modal
    function closeModal() {
        const modal = document.getElementById('editModal');

        if (modal) {
            modal.classList.add('hidden');
        }
    }


    // Close when clicking outside modal
    document.addEventListener('click', function (event) {

        const modal = document.getElementById('editModal');

        if (modal && event.target === modal) {
            closeModal();
        }

    });

</script>

@endpush