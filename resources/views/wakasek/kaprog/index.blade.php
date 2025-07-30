@extends('layouts.app')

@section('content')
    <!-- Styles & Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: #f8fafc;
            font-family: 'poppins', sans-serif;
            color: #334155;
        }

        .main-content {
            padding: 2rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .header {
            background: #fff;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .header p {
            color: #64748b;
            font-size: 0.95rem;
            margin: 0;
        }

        .add-button {
            background: #0083ee;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
            gap: 0.5rem;
            position: absolute;
            top: 1.5rem;
            right: 2rem;
        }

        .stats-grid {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            background: white;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }

        .data-table {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem;
            font-size: 0.9rem;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        th {
            background: #f9fafb;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #0083ee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 0.75rem;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .badge-jurusan {
            display: inline-block;
            padding: 0.3rem 0.6rem;
            font-size: 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .badge-tjkt {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #dbeafe;
        }

        .badge-rpl {
            background: #f0fdf4;
            color: #166534;
            border-color: #dcfce7;
        }

        .badge-dkv {
            background: #faf5ff;
            color: #7c3aed;
            border-color: #f3e8ff;
        }

        .badge-akl {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fee2e2;
        }

        .badge-mlog {
            background: #f0f9ff;
            color: #0369a1;
            border-color: #e0f2fe;
        }

        .badge-pm {
            background: #fffbeb;
            color: #d97706;
            border-color: #fef3c7;
        }

        .badge-mplb {
            background: #f0f9ff;
            color: #0284c7;
            border-color: #e0f2fe;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .success-alert {
            background: #10b981;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {

            .header,
            .main-content {
                padding: 1rem;
            }

            .add-button {
                position: static;
                width: 100%;
                justify-content: center;
                margin-top: 1rem;
            }
        }
    </style>

    <div class="main-content">
        <div class="header">
            <h1>Data Ketua Program</h1>
            <p>Kelola data ketua program keahlian dengan mudah dan efisien</p>
            <a href="#" class="add-button" data-bs-toggle="modal" data-bs-target="#modalTambahKaprog">
                <i class="bi bi-plus-circle"></i> Tambah Ketua Program
            </a>
        </div>

        @if (session('success'))
            <div class="success-alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon text-primary"><i class="bi bi-people"></i></div>
                <div class="stat-number">{{ $ketua_program->count() }}</div>
                <div class="stat-label">Total Ketua Program</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon text-success"><i class="bi bi-building"></i></div>
                <div class="stat-number">{{ $ketua_program->pluck('jurusan')->unique()->count() }}</div>
                <div class="stat-label">Program Keahlian</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon text-purple"><i class="bi bi-person-check"></i></div>
                <div class="stat-number">88</div>
                <div class="stat-label">Status Aktif</div>
            </div>
        </div>

        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th><i class="bi bi-person-badge"></i> NIP</th>
                        <th><i class="bi bi-person"></i> Nama</th>
                        <th><i class="bi bi-building"></i> Jurusan</th>
                        <th><i class="bi bi-person-circle"></i> Username</th>
                        <th><i class="bi bi-gear"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ketua_program as $kaprog)
                        <tr>
                            <td><strong>{{ $kaprog->nip_kaprog }}</strong></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">{{ strtoupper(substr($kaprog->nama_ketua_program, 0, 2)) }}
                                    </div>
                                    <span>{{ $kaprog->nama_ketua_program }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-jurusan badge-{{ strtolower($kaprog->jurusan) }}">
                                    <i class="bi bi-mortarboard me-1"></i> {{ strtoupper($kaprog->jurusan) }}
                                </span>
                            </td>
                            <td>{{ $kaprog->user->username ?? '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="action-btn btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#modalEditKaprog{{ $kaprog->nip_kaprog }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEditKaprog{{ $kaprog->nip_kaprog }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $kaprog->nip_kaprog }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('wakasek.kaprog.update', $kaprog->nip_kaprog) }}"
                                                method="POST" class="modal-content">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $kaprog->nip_kaprog }}">Edit
                                                        Ketua Program</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>NIP Kaprog</label>
                                                        <input type="text" class="form-control" name="nip_kaprog"
                                                            value="{{ $kaprog->nip_kaprog }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nama Ketua Program</label>
                                                        <input type="text" class="form-control" name="nama_ketua_program"
                                                            value="{{ $kaprog->nama_ketua_program }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Jurusan</label>
                                                        <input type="text" class="form-control" name="jurusan"
                                                            value="{{ $kaprog->jurusan }}" required>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <form action="{{ route('wakasek.kaprog.destroy', $kaprog->nip_kaprog) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Kaprog -->
    <div class="modal fade" id="modalTambahKaprog" tabindex="-1" aria-labelledby="modalTambahKaprogLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('wakasek.kaprog.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKaprogLabel">Tambah Ketua Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nip_kaprog" class="form-label">NIP Kaprog</label>
                        <input type="text" class="form-control" name="nip_kaprog" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_ketua_program" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_ketua_program" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
