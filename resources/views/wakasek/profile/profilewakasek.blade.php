@extends('layouts.wakasek.app')

@section('content')
    <div class="max-w-6xl mx-auto p-8 space-y-8">
        <!-- Profile Section -->
        <div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-8">
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl p-8 shadow-sm text-center h-full">
                <div
                    class="w-[100px] h-[100px] bg-slate-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-6 text-slate-500 border-3 border-slate-200">
                    <i class="bi bi-person"></i>
                </div>
                <h1 class="profile-name text-2xl font-semibold text-slate-800 mb-2">
                    @if (auth()->user()->role == 2)
                        @auth
                            {{ Auth::user()->gurubk->nama_guru_bk }}
                        @endauth
                    @else
                        @auth
                            {{ Auth::user()->wakasek->nama_wakasek }}
                        @endauth
                    @endif

                </h1>
                <p class="profile-title text-blue-600 font-medium mb-6 text-sm">Wakil Kepala Kesiswaan</p>
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
                <h2
                    class="text-xl font-semibold text-slate-800 mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-[30px] after:h-0.5 after:bg-blue-600 after:rounded-sm">
                    Informasi Profile
                </h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                        <div class="text-sm font-medium text-slate-500">Nama Lengkap</div>
                        <div class="info-value text-sm font-medium text-slate-800">
                            @if (auth()->user()->role == 2)
                                @auth
                                    {{ Auth::user()->gurubk->nama_guru_bk }}
                                @endauth
                            @else
                                @auth
                                    {{ Auth::user()->wakasek->nama_wakasek }}
                                @endauth
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                        <div class="text-sm font-medium text-slate-500">NIP</div>
                        <div class="info-value text-sm font-medium text-slate-800">
                            @if (auth()->user()->role == 2)
                                @auth
                                    {{ Auth::user()->gurubk->nip_bk }}
                                @endauth
                            @else
                                @auth
                                    {{ Auth::user()->wakasek->nip_wakasek }}
                                @endauth
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                        <div class="text-sm font-medium text-slate-500">Email</div>
                        <div class="info-value text-sm font-medium text-slate-800">
                           
                                    {{ Auth::user()->email }}
                               
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                        <div class="text-sm font-medium text-slate-500">Jabatan</div>
                        <div class="info-value text-sm font-medium text-slate-800">
                         @if (auth()->user()->role == 2)
                                Guru Bimbingan Konseling    
                            @else
                                Wakil Kepala Kesiswaan
                            @endif</div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    @push('css')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

            body {
                font-family: 'Inter', sans-serif;
                background: #fafbfc;
            }

            /* Custom animations that can't be replicated with Tailwind */
            .card-animate {
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.4s ease;
            }

            .card-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .btn-animate:active {
                transform: scale(0.98);
            }

            .quick-action:active {
                transform: scale(0.98);
            }

            .stat-item:hover {
                transform: translateY(-2px);
            }
        </style>
    @endpush

    @push('js')
        <script>
            // Simple fade-in animation
            document.addEventListener('DOMContentLoaded', function() {
                const elements = document.querySelectorAll('.bg-white');
                elements.forEach((element, index) => {
                    element.classList.add('card-animate');

                    setTimeout(() => {
                        element.classList.add('visible');
                    }, index * 50);
                });
            });

            // Modal functionality
            const editBtn = document.getElementById('editProfileBtn');
            const modal = document.getElementById('editModal');
            const modalContent = document.getElementById('modalContent');
            const closeBtn = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const editForm = document.getElementById('editForm');

            // Open modal
            editBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            });

            // Close modal function
            function closeModal() {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }

            // Close modal events
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Handle form submission
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const namaLengkap = document.getElementById('namaLengkap').value;
                const nip = document.getElementById('nip').value;
                const email = document.getElementById('email').value;
                const jabatan = document.getElementById('jabatan').value;
                const telepon = document.getElementById('telepon').value;

                // Update profile display
                document.querySelector('.profile-name').textContent = namaLengkap;
                document.querySelector('.profile-title').textContent = jabatan;

                // Update profile information section
                const infoValues = document.querySelectorAll('.info-value');
                infoValues[0].textContent = namaLengkap;
                infoValues[1].textContent = nip;
                infoValues[2].textContent = email;
                infoValues[3].textContent = jabatan;
                infoValues[4].textContent = telepon;

                // Show success message (optional)
                alert('Profile berhasil diperbarui!');

                // Close modal
                closeModal();
            });

            // Button click effects
            document.querySelectorAll('.btn-animate, .quick-action').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (this.id !== 'editProfileBtn') {
                        e.preventDefault();
                    }
                    // Animation handled by CSS :active pseudo-class
                });
            });
        </script>
    @endpush
