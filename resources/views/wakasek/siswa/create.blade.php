<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <button onclick="goBack()" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Siswa
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-blue-600 text-white px-6 py-4">
                    <h1 class="text-2xl font-bold">Tambah Siswa Baru</h1>
                    <p class="text-blue-100 mt-1">Lengkapi form di bawah untuk menambahkan siswa baru</p>
                </div>

                <!-- Form -->
                <form id="studentForm" class="p-6 space-y-6">
                    <!-- NIS Field -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Induk Siswa (NIS) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nis" 
                               name="nis" 
                               required
                               placeholder="Contoh: 2024001"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <p class="mt-1 text-sm text-gray-500">Masukkan NIS yang unik untuk siswa</p>
                        <div id="nisError" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <!-- Nama Field -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               required
                               placeholder="Contoh: Ahmad Rizki Pratama"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <p class="mt-1 text-sm text-gray-500">Masukkan nama lengkap siswa</p>
                        <div id="namaError" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <!-- Kelas Field -->
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select id="kelas" 
                                name="kelas" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">Pilih Kelas</option>
                            <optgroup label="Kelas X">
                                <option value="X IPA 1">X IPA 1</option>
                                <option value="X IPA 2">X IPA 2</option>
                                <option value="X IPS 1">X IPS 1</option>
                                <option value="X IPS 2">X IPS 2</option>
                            </optgroup>
                            <optgroup label="Kelas XI">
                                <option value="XI IPA 1">XI IPA 1</option>
                                <option value="XI IPA 2">XI IPA 2</option>
                                <option value="XI IPS 1">XI IPS 1</option>
                                <option value="XI IPS 2">XI IPS 2</option>
                            </optgroup>
                            <optgroup label="Kelas XII">
                                <option value="XII IPA 1">XII IPA 1</option>
                                <option value="XII IPA 2">XII IPA 2</option>
                                <option value="XII IPS 1">XII IPS 1</option>
                                <option value="XII IPS 2">XII IPS 2</option>
                            </optgroup>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Pilih kelas yang sesuai</p>
                        <div id="kelasError" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <!-- Total Poin Field -->
                    <div>
                        <label for="total_poin" class="block text-sm font-medium text-gray-700 mb-2">
                            Total Poin <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="total_poin" 
                                   name="total_poin" 
                                   required
                                   min="0" 
                                   max="100"
                                   placeholder="Contoh: 85"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">/ 100</span>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center space-x-4 text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-100 rounded-full mr-2"></div>
                                <span class="text-gray-600">0-69: Need Improvement</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-100 rounded-full mr-2"></div>
                                <span class="text-gray-600">70-79: Good</span>
                            </div>
                        </div>
                        <div class="mt-1 flex items-center space-x-4 text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-100 rounded-full mr-2"></div>
                                <span class="text-gray-600">80-89: Very Good</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-100 rounded-full mr-2"></div>
                                <span class="text-gray-600">90-100: Excellent</span>
                            </div>
                        </div>
                        <div id="poinError" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <!-- Preview Card -->
                    <div id="previewCard" class="hidden bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Preview Data Siswa</h3>
                        <div class="flex items-center space-x-4">
                            <div id="previewAvatar" class="h-12 w-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                --
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <span id="previewNama" class="font-medium text-gray-900">-</span>
                                    <span id="previewBadge" class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">-</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span>NIS: </span><span id="previewNis">-</span>
                                    <span class="mx-2">•</span>
                                    <span>Kelas: </span><span id="previewKelas">-</span>
                                    <span class="mx-2">•</span>
                                    <span>Poin: </span><span id="previewPoin">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Siswa
                        </button>
                        <button type="button" 
                                onclick="resetForm()"
                                class="flex-1 sm:flex-none bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Form
                        </button>
                        <button type="button" 
                                onclick="goBack()"
                                class="flex-1 sm:flex-none bg-white hover:bg-gray-50 text-gray-700 font-medium py-3 px-6 rounded-lg border border-gray-300 transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Siswa Berhasil Ditambahkan!</h3>
                <p class="text-sm text-gray-500 mb-4">Data siswa telah berhasil disimpan ke dalam sistem.</p>
                <div class="flex gap-3">
                    <button onclick="closeSuccessModal()" 
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        OK
                    </button>
                    <button onclick="addAnother()" 
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        Tambah Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mendapatkan inisial nama
        function getInitials(nama) {
            if (!nama) return '--';
            return nama.split(' ').map(word => word.charAt(0)).join('').substring(0, 2).toUpperCase();
        }

        // Fungsi untuk mendapatkan badge berdasarkan poin
        function getPointBadge(poin) {
            if (!poin) return { class: 'bg-gray-100 text-gray-800', text: '-' };
            
            const point = parseInt(poin);
            if (point >= 90) {
                return { class: 'bg-green-100 text-green-800', text: 'Excellent' };
            } else if (point >= 80) {
                return { class: 'bg-blue-100 text-blue-800', text: 'Very Good' };
            } else if (point >= 70) {
                return { class: 'bg-yellow-100 text-yellow-800', text: 'Good' };
            } else {
                return { class: 'bg-red-100 text-red-800', text: 'Need Improvement' };
            }
        }

        // Fungsi untuk update preview
        function updatePreview() {
            const nis = document.getElementById('nis').value;
            const nama = document.getElementById('nama').value;
            const kelas = document.getElementById('kelas').value;
            const poin = document.getElementById('total_poin').value;

            // Show/hide preview card
            const previewCard = document.getElementById('previewCard');
            if (nis || nama || kelas || poin) {
                previewCard.classList.remove('hidden');
                
                // Update avatar
                document.getElementById('previewAvatar').textContent = getInitials(nama);
                
                // Update preview content
                document.getElementById('previewNama').textContent = nama || '-';
                document.getElementById('previewNis').textContent = nis || '-';
                document.getElementById('previewKelas').textContent = kelas || '-';
                document.getElementById('previewPoin').textContent = poin || '-';
                
                // Update badge
                const badge = getPointBadge(poin);
                const badgeElement = document.getElementById('previewBadge');
                badgeElement.className = `inline-flex px-2 py-1 text-xs font-semibold rounded-full ${badge.class}`;
                badgeElement.textContent = badge.text;
            } else {
                previewCard.classList.add('hidden');
            }
        }

        // Fungsi validasi NIS
        function validateNIS(nis) {
            if (!nis) return 'NIS wajib diisi';
            if (nis.length < 4) return 'NIS minimal 4 karakter';
            if (!/^\d+$/.test(nis)) return 'NIS hanya boleh berisi angka';
            return null;
        }

        // Fungsi validasi Nama
        function validateNama(nama) {
            if (!nama) return 'Nama wajib diisi';
            if (nama.length < 3) return 'Nama minimal 3 karakter';
            if (!/^[a-zA-Z\s]+$/.test(nama)) return 'Nama hanya boleh berisi huruf dan spasi';
            return null;
        }

        // Fungsi validasi Poin
        function validatePoin(poin) {
            if (!poin) return 'Total poin wajib diisi';
            const point = parseInt(poin);
            if (isNaN(point)) return 'Total poin harus berupa angka';
            if (point < 0 || point > 100) return 'Total poin harus antara 0-100';
            return null;
        }

        // Fungsi untuk menampilkan error
        function showError(fieldId, message) {
            const errorElement = document.getElementById(fieldId + 'Error');
            const inputElement = document.getElementById(fieldId);
            
            if (message) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
                inputElement.classList.add('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                inputElement.classList.remove('border-gray-300', 'focus:ring-blue-500', 'focus:border-transparent');
            } else {
                errorElement.classList.add('hidden');
                inputElement.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                inputElement.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-transparent');
            }
        }

        // Fungsi untuk validasi real-time
        function setupRealTimeValidation() {
            document.getElementById('nis').addEventListener('input', function() {
                const error = validateNIS(this.value);
                showError('nis', error);
                updatePreview();
            });

            document.getElementById('nama').addEventListener('input', function() {
                const error = validateNama(this.value);
                showError('nama', error);
                updatePreview();
            });

            document.getElementById('kelas').addEventListener('change', function() {
                const error = this.value ? null : 'Kelas wajib dipilih';
                showError('kelas', error);
                updatePreview();
            });

            document.getElementById('total_poin').addEventListener('input', function() {
                const error = validatePoin(this.value);
                showError('poin', error);
                updatePreview();
            });
        }

        // Fungsi submit form
        function handleSubmit(e) {
            e.preventDefault();
            
            const nis = document.getElementById('nis').value;
            const nama = document.getElementById('nama').value;
            const kelas = document.getElementById('kelas').value;
            const poin = document.getElementById('total_poin').value;

            // Validasi semua field
            const nisError = validateNIS(nis);
            const namaError = validateNama(nama);
            const kelasError = kelas ? null : 'Kelas wajib dipilih';
            const poinError = validatePoin(poin);

            showError('nis', nisError);
            showError('nama', namaError);
            showError('kelas', kelasError);
            showError('poin', poinError);

            // Jika ada error, stop
            if (nisError || namaError || kelasError || poinError) {
                return;
            }

            // Simulasi penyimpanan data
            console.log('Data siswa yang akan disimpan:', {
                nis, nama, kelas, total_poin: poin
            });

            // Tampilkan modal sukses
            document.getElementById('successModal').classList.remove('hidden');
        }

        // Fungsi reset form
        function resetForm() {
            document.getElementById('studentForm').reset();
            document.getElementById('previewCard').classList.add('hidden');
            
            // Clear all errors
            ['nis', 'nama', 'kelas', 'poin'].forEach(fieldId => {
                showError(fieldId, null);
            });
        }

        // Fungsi kembali
        function goBack() {
            if (confirm('Apakah Anda yakin ingin kembali? Data yang belum disimpan akan hilang.')) {
                // Redirect ke halaman daftar siswa
                window.history.back();
            }
        }

        // Fungsi tutup modal sukses
        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
            goBack();
        }

        // Fungsi tambah siswa lagi
        function addAnother() {
            document.getElementById('successModal').classList.add('hidden');
            resetForm();
        }

        // Setup event listeners
        document.addEventListener('DOMContentLoaded', function() {
            setupRealTimeValidation();
            document.getElementById('studentForm').addEventListener('submit', handleSubmit);
            
            // Close modal when clicking outside
            document.getElementById('successModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeSuccessModal();
                }
            });
        });
    </script>
</body>
</html>