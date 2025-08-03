
@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 text-white px-6 py-4">
                <h1 class="text-2xl font-bold">Data Siswa</h1>
                <p class="text-blue-100 mt-1">Daftar siswa dan informasi akademik</p>

                <div class="mt-4">
                    <a href="{{ route('siswa.create') }}" class="inline-block bg-white text-blue-600 px-4 py-2 rounded-lg shadow hover:bg-gray-100">
                        <b> + Tambah Siswa</b>
                    </a>
                </div>
            </div>
            </div>

            <!-- Search Bar -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" id="searchInput" placeholder="Cari nama siswa atau NIS..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="sm:w-48">
                        <select id="kelasFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Kelas</option>
                            <option value="X IPA 1">X IPA 1</option>
                            <option value="X IPA 2">X IPA 2</option>
                            <option value="XI IPA 1">XI IPA 1</option>
                            <option value="XI IPA 2">XI IPA 2</option>
                            <option value="XII IPA 1">XII IPA 1</option>
                            <option value="XII IPA 2">XII IPA 2</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NIS
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Siswa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Poin
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    {{-- <tbody id="studentTableBody" class="bg-white divide-y divide-gray-200"> --}}

                       <tbody>
                        @foreach ($siswa as $s)
                        <tr>
                            <td class="text-center">
                                1
                            </td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>{{ $s->id_kelas }}</td>
                            <td>{{ $s->point }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $s->nama_siswa }} (NIS: {{ $s->nis }})?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>

            

            <!-- Empty State -->
            <div id="emptyState" class="hidden p-12 text-center">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    <p class="mt-2 text-sm font-medium text-gray-900">Tidak ada data siswa ditemukan</p>
                    <p class="mt-1 text-sm text-gray-500">Coba ubah kriteria pencarian Anda.</p>
                </div>
            </div>

           

    <!-- Modal untuk Detail Siswa -->
    <div id="detailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Detail Siswa</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent">
                    <!-- Content akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data siswa contoh
        const studentsData = [
            { id: 1, nis: '2024001', nama: 'Ahmad Rizki Pratama', kelas: 'X IPA 1', total_poin: 85 },
            { id: 2, nis: '2024002', nama: 'Siti Nurhaliza', kelas: 'X IPA 1', total_poin: 92 }
        ];

        let filteredStudents = [...studentsData];

        // Fungsi untuk mendapatkan badge status berdasarkan poin
        function getPointBadge(poin) {
            if (poin >= 90) {
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Excellent</span>';
            } else if (poin >= 80) {
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Very Good</span>';
            } else if (poin >= 70) {
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Good</span>';
            } else {
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Need Improvement</span>';
            }
        }

        // Fungsi untuk mendapatkan inisial nama
        function getInitials(nama) {
            return nama.split(' ').map(word => word.charAt(0)).join('').substring(0, 2).toUpperCase();
        }

        // Fungsi untuk render tabel
        function renderTable() {
            const tbody = document.getElementById('studentTableBody');
            const emptyState = document.getElementById('emptyState');
            
            if (filteredStudents.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }
            
            emptyState.classList.add('hidden');
            
            tbody.innerHTML = filteredStudents.map((student, index) => `
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${index + 1}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${student.nis}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                                    ${getInitials(student.nama)}
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    ${student.nama}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                            ${student.kelas}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-900 mr-2">
                                ${student.total_poin}
                            </div>
                            ${getPointBadge(student.total_poin)}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button onclick="showDetail(${student.id})" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="editStudent(${student.id})" 
                                   class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Fungsi pencarian
        function filterStudents() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const kelasFilter = document.getElementById('kelasFilter').value;
            
            filteredStudents = studentsData.filter(student => {
                const matchSearch = student.nama.toLowerCase().includes(searchTerm) || 
                                  student.nis.toLowerCase().includes(searchTerm);
                const matchKelas = !kelasFilter || student.kelas === kelasFilter;
                
                return matchSearch && matchKelas;
            });
            
            renderTable();
        }

        // Fungsi untuk menampilkan detail siswa
        function showDetail(studentId) {
            const student = studentsData.find(s => s.id === studentId);
            if (!student) return;
            
            document.getElementById('modalContent').innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="h-16 w-16 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xl">
                            ${getInitials(student.nama)}
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">${student.nama}</h4>
                            <p class="text-sm text-gray-600">NIS: ${student.nis}</p>
                        </div>
                    </div>
                    <div class="border-t pt-4">
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Kelas:</dt>
                                <dd class="text-sm text-gray-900">${student.kelas}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Total Poin:</dt>
                                <dd class="text-sm text-gray-900">${student.total_poin}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Status:</dt>
                                <dd class="text-sm text-gray-900">${getPointBadge(student.total_poin)}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            `;
            
            document.getElementById('detailModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Fungsi placeholder untuk edit
        function editStudent(studentId) {
            alert(`Edit siswa dengan ID: ${studentId}\n(Fitur ini akan dikembangkan)`);
        }

        // Fungsi placeholder untuk tambah siswa
        function showAddForm() {
            alert('Form tambah siswa akan ditampilkan\n(Fitur ini akan dikembangkan)');
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', filterStudents);
        document.getElementById('kelasFilter').addEventListener('change', filterStudents);

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initial render
        renderTable();
    </script>
</body>
</html>
@endsection