@extends('layouts.app')

@push('css')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
            transition: all 0.2s ease;
        }

        .modal-overlay {
            z-index: 9999 !important;
        }

        body.modal-open {
            overflow: hidden;
        }
    </style>

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
@endpush

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Data Ketua Program</h1>
            <p class="text-gray-600">Kelola data ketua program</p>
        </div>
        <button onclick="openCreateModal()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Ketua Program
        </button>
    </div>

    @if (session('success'))
        <p class="text-sm text-green-600 font-semibold">✅ {{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="text-sm text-red-600 font-semibold">❌ {{ session('error') }}</p>
    @endif

    {{-- Search & Filter --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border flex flex-col md:flex-row gap-2 items-center justify-between">
        <div class="relative w-full md:w-64">
            <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
            <input type="text" id="customSearch" placeholder="Cari Ketua Program..."
                class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg w-full">
        </div>
        <div class="flex gap-2">
            <label for="entryLength" class="mr-2 text-sm text-gray-600">Tampilkan</label>
            <select id="entryLength" class="py-1 px-2 border border-gray-300 rounded-md text-sm">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold">Daftar Ketua Program</h3>
        </div>
        <div class="overflow-x-auto">
            <table id="ketuaTable" class="w-full table-hover">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Nama Ketua Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold">Jurusan</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- DataTables will populate here --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('wakasek.kaprog.create')
@include('wakasek.kaprog.edit')
@include('wakasek.kaprog.delete')
@endsection

@push('js')
    {{-- jQuery & DataTables JS --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            openModal('modal-create');
        }

        function openEditModal(nip, nama, jurusan, uname) {
            document.getElementById('edit_nip').value = nip;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jurusan').value = jurusan;
            document.getElementById('username').value = uname;
            document.getElementById('form-edit').action = `/kaprog/${nip}/${uname}/update`;
            openModal('modal-edit');
        }

        function openDeleteModal(nip, nama) {
            document.getElementById('delete-nama-ketua').innerText = nama;
            document.getElementById('form-delete').action = `/kaprog/${nip}`;
            openModal('modal-delete');
        }

        // Close modal on outside click or Esc
        document.addEventListener('click', e => ['modal-create', 'modal-edit', 'modal-delete'].forEach(id => {
            const m = document.getElementById(id);
            if (m && !m.classList.contains('hidden') && e.target === m) closeModal(id);
        }));
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape')['modal-create', 'modal-edit', 'modal-delete'].forEach(id => {
                const m = document.getElementById(id);
                if (m && !m.classList.contains('hidden')) closeModal(id);
            });
        });

        // DataTables Init
        $(document).ready(function() {
            var table = $('#ketuaTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url()->current() }}',
                    data: function(d) {
                        // custom params if needed
                    }
                },
                columns: [
                    { data: 'nip_kaprog', name: 'nip_kaprog' },
                    { data: 'nama_ketua_program', name: 'nama_ketua_program' },
                    { data: 'email', name: 'email' },
                    { data: 'jurusan', name: 'jurusan' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ],
                dom: 'rtip',
                language: {
                    processing: "Memproses...",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                pageLength: 10,
                drawCallback: function() {
                    $('.dataTables_paginate .paginate_button').addClass(
                        'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50'
                    );
                    $('.dataTables_paginate .paginate_button.current').addClass(
                        'z-10 bg-blue-50 border-blue-500 text-blue-600'
                    ).removeClass('text-gray-500');
                    $('.dataTables_info').addClass('text-sm text-gray-700');
                }
            });

            $('#entryLength').on('change', function() {
                table.page.len($(this).val()).draw();
            });

            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
