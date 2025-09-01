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
            <h1 class="profile-name text-2xl font-semibold text-slate-800 mb-2">Elan Pratama S.pd</h1>
            <p class="profile-title text-blue-600 font-medium mb-6 text-sm">Wakil Kepala Sekolah</p>
            <div class="flex flex-col gap-3">
                <button id="editProfileBtn"
                    class="flex items-center justify-center px-4 py-3 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors w-full btn-animate">
                    <i class="bi bi-pencil mr-2"></i>
                    Edit Profile
                </button>
                <form method="POST" action="#" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center px-4 py-3 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors w-full btn-animate">
                        <i class="bi bi-box-arrow-right mr-2"></i>
                        Logout
                    </button>
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
                    <div class="info-value text-sm font-medium text-slate-800">Elan Pratama S.pd</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                    <div class="text-sm font-medium text-slate-500">NIP</div>
                    <div class="info-value text-sm font-medium text-slate-800">196512121990031001</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                    <div class="text-sm font-medium text-slate-500">Email</div>
                    <div class="info-value text-sm font-medium text-slate-800">elann03@smkn1bandung.sch.id</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4 py-3 border-b border-slate-100">
                    <div class="text-sm font-medium text-slate-500">Jabatan</div>
                    <div class="info-value text-sm font-medium text-slate-800">Wakil Kepala Sekolah</div>
                </div>
              
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0"
            id="modalContent">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-slate-800">Edit Profile</h3>
                <button id="closeModal" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>

            <form id="editForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" value="Elan Pratama S.pd"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">NIP</label>
                    <input type="text" id="nip" value="196512121990031001"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                    <input type="email" id="email" value="elann03@smkn1bandung.sch.id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Jabatan</label>
                    <select id="jabatan"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="Wakil Kepala Sekolah" selected>Wakil Kepala Sekolah</option>
                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                        <option value="Guru">Guru</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" id="cancelBtn"
                        class="flex-1 px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
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