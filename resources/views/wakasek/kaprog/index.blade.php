@extends('layouts.app')

@section('content')
<style>
    .gradient-text {
        background: linear-gradient(135deg, #0083ee, #0a50c1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #0083ee, #0a50c1);
        transition: all 0.3s ease;
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 131, 238, 0.2);
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 131, 238, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .table-row-hover:hover {
        background-color: #f8fafc;
        transform: scale(1.002);
        transition: all 0.2s ease;
    }
    
    .action-btn {
        transition: all 0.2s ease;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-right: 6px;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }
    
    .btn-edit {
        background-color: #f59e0b;
        color: white;
    }
    
    .btn-edit:hover {
        background-color: #d97706;
        color: white;
    }
    
    .btn-delete {
        background-color: #ef4444;
        color: white;
    }
    
    .btn-delete:hover {
        background-color: #dc2626;
        color: white;
    }
    
    .alert-success-custom {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 16px 24px;
        margin-bottom: 24px;
        animation: slideDown 0.5s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .jurusan-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-tjkt { background-color: #dbeafe; color: #1e40af; }
    .badge-rpl { background-color: #dcfce7; color: #166534; }
    .badge-dkv { background-color: #f3e8ff; color: #7c3aed; }
    .badge-akl { background-color: #fee2e2; color: #dc2626; }
    .badge-mlog { background-color: #e0f2fe; color: #0369a1; }
    .badge-pm { background-color: #fef3c7; color: #d97706; }
    .badge-mplb { background-color: #f0f9ff; color: #0284c7; }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        margin-right: 12px;
    }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">

<!-- Main Container -->
<div class="container-fluid px-4 py-4">
    
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="gradient-text mb-2" style="font-size: 2.5rem; font-weight: bold;">Data Ketua Program</h1>
                    <p class="text-muted">Kelola data ketua program keahlian</p>
                </div>
                
                <!-- Add Button -->
                <a href="{{ route('wakasek.kaprog.create') }}" class="btn-primary-custom">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Ketua Program
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    @if(session('success'))
        <div class="alert alert-success-custom d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-3" style="font-size: 1.2rem;"></i>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm card-hover" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded" style="background-color: #dbeafe;">
                            <i class="bi bi-people text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-1 small">Total Ketua Program</p>
                            <h3 class="mb-0 fw-bold">7</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm card-hover" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded" style="background-color: #dcfce7;">
                            <i class="bi bi-building text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-1 small">Program Keahlian</p>
                            <h3 class="mb-0 fw-bold">{{ $data->pluck('jurusan')->unique()->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm card-hover" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded" style="background-color: #f3e8ff;">
                            <i class="bi bi-person-check" style="color: #7c3aed; font-size: 1.5rem;"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-1 small">Aktif</p>
                            <h3 class="mb-0 fw-bold">{{ $data->whereNotNull('user_id')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-white border-bottom" style="padding: 20px 24px;">
            <h5 class="mb-0 fw-semibold">Daftar Ketua Program</h5>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="border-0 py-3 px-4">
                                <div class="d-flex align-items-center text-muted small fw-semibold text-uppercase">
                                    <i class="bi bi-person-badge me-2"></i>
                                    NIP Kaprog
                                </div>
                            </th>
                            <th class="border-0 py-3 px-4">
                                <div class="d-flex align-items-center text-muted small fw-semibold text-uppercase">
                                    <i class="bi bi-person me-2"></i>
                                    Nama
                                </div>
                            </th>
                            <th class="border-0 py-3 px-4">
                                <div class="d-flex align-items-center text-muted small fw-semibold text-uppercase">
                                    <i class="bi bi-building me-2"></i>
                                    Jurusan
                                </div>
                            </th>
                            <th class="border-0 py-3 px-4">
                                <div class="d-flex align-items-center text-muted small fw-semibold text-uppercase">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Nama User
                                </div>
                            </th>
                            <th class="border-0 py-3 px-4">
                                <div class="d-flex align-items-center text-muted small fw-semibold text-uppercase">
                                    <i class="bi bi-gear me-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data TJKT -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">196505151990031001</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #dbeafe; color: #1e40af;">
                                        AB
                                    </div>
                                    <div class="fw-medium">Ahmad Budi Setiawan, S.Kom</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-tjkt">
                                    <i class="bi bi-cpu me-1"></i>
                                    TJKT
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>ahmad.budi</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Ahmad Budi Setiawan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Data RPL -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">197203101998032002</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #dcfce7; color: #166534;">
                                        CS
                                    </div>
                                    <div class="fw-medium">Citra Sari Dewi, S.Pd</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-rpl">
                                    <i class="bi bi-code-slash me-1"></i>
                                    RPL
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>citra.sari</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Citra Sari Dewi?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Data DKV -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">198012052006041003</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #f3e8ff; color: #7c3aed;">
                                        DP
                                    </div>
                                    <div class="fw-medium">Deni Pratama, S.Sn</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-dkv">
                                    <i class="bi bi-palette me-1"></i>
                                    DKV
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>deni.pratama</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Deni Pratama?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Data AKL -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">197508152000031004</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #fee2e2; color: #dc2626;">
                                        ES
                                    </div>
                                    <div class="fw-medium">Eka Sari Wulandari, S.E</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-akl">
                                    <i class="bi bi-calculator me-1"></i>
                                    AKL
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>eka.sari</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Eka Sari Wulandari?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Data MLOG -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">198506202010121005</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #e0f2fe; color: #0369a1;">
                                        FH
                                    </div>
                                    <div class="fw-medium">Fajar Hidayat Ramadan, S.T</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-mlog">
                                    <i class="bi bi-truck me-1"></i>
                                    MLOG
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>fajar.hidayat</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Fajar Hidayat Ramadan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Data PM -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">197904122003122006</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #fef3c7; color: #d97706;">
                                        GR
                                    </div>
                                    <div class="fw-medium">Gita Rahayu Putri, S.E</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-pm">
                                    <i class="bi bi-briefcase me-1"></i>
                                    PM
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>gita.rahayu</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Gita Rahayu Putri?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Data MPLB -->
                        <tr class="table-row-hover">
                            <td class="py-3 px-4 border-0">
                                <div class="fw-medium">198008172005011007</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar" style="background-color: #f0f9ff; color: #0284c7;">
                                        HN
                                    </div>
                                    <div class="fw-medium">Hendra Nugraha, S.Pd</div>
                                </div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <span class="jurusan-badge badge-mplb">
                                    <i class="bi bi-shop me-1"></i>
                                    MPLB
                                </span>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div>hendra.nugraha</div>
                            </td>
                            <td class="py-3 px-4 border-0">
                                <div class="d-flex">
                                    <a href="#" class="action-btn btn-edit">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                    <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data Hendra Nugraha?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination (if needed) -->
    
</div>

<script>
    // Auto hide success alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-success-custom');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }, 5000);
        });
    });
</script>
@endsection