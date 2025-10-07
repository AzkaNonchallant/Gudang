@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-primary mb-1">Daftar Barang</h1>
            <p class="text-muted mb-0">Kelola inventory barang Anda dengan mudah</p>
        </div>
        <a href="{{ route('barangs.create') }}" class="btn btn-primary btn-lg px-4 rounded-3 fw-semibold">
            <i class="fas fa-plus-circle me-2"></i>Tambah Barang
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center">
            <i class="fas fa-check-circle me-2 fs-5"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 bg-primary text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="card-title h6 fw-semibold opacity-75">Total Barang</h4>
                            <h3 class="mb-0 fw-bold">{{ $barangs->count() }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-cube fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 bg-success text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="card-title h6 fw-semibold opacity-75">Total Stok</h4>
                            <h3 class="mb-0 fw-bold">{{ $barangs->sum('stok') }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-boxes fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 bg-warning text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="card-title h6 fw-semibold opacity-75">Total Nilai</h4>
                            <h3 class="mb-0 fw-bold">Rp {{ number_format($barangs->sum(function($item) { return $item->stok * $item->harga; }), 0, ',', '.') }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-money-bill-wave fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 bg-info text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="card-title h6 fw-semibold opacity-75">Rata-rata Harga</h4>
                            <h3 class="mb-0 fw-bold">Rp {{ $barangs->count() > 0 ? number_format($barangs->avg('harga'), 0, ',', '.') : 0 }}</h3>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-bottom-0 py-4">
            <h5 class="card-title mb-0 fw-semibold text-dark">
                <i class="fas fa-list me-2 text-primary"></i>Daftar Semua Barang
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 fw-semibold text-muted py-3 ps-4">
                                <i class="fas fa-barcode me-2"></i>Kode
                            </th>
                            <th class="border-0 fw-semibold text-muted py-3">
                                <i class="fas fa-tag me-2"></i>Nama Barang
                            </th>
                            <th class="border-0 fw-semibold text-muted py-3 text-center">
                                <i class="fas fa-boxes me-2"></i>Stok
                            </th>
                            <th class="border-0 fw-semibold text-muted py-3 text-end">
                                <i class="fas fa-money-bill-wave me-2"></i>Harga
                            </th>
                            <th class="border-0 fw-semibold text-muted py-3">
                                <i class="fas fa-calendar-alt me-2"></i>Tanggal Masuk
                            </th>
                            <th class="border-0 fw-semibold text-muted py-3 ">
                                <i class="fas fa-user me-2"></i>Diunggah Oleh
                            </th>
                            <th class="border-0 fw-semibold text-muted py-3 text-center">
                                <i class="fas fa-cogs me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr class="border-bottom">
                                <td class="ps-4 py-3">
                                    <span class="fw-semibold text-dark">{{ $barang->kode ?: '-' }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-2 me-3">
                                            <i class="fas fa-cube text-white" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $barang->nama }}</h6>
                                            <small class="text-muted">ID: #{{ $barang->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center py-3">
                                    <span class="badge 
                                        {{ $barang->stok <= ($barang->minimum_stok ?? 1) ? 'bg-danger' : 
                                           ($barang->stok <= (($barang->minimum_stok ?? 1) * 2) ? 'bg-warning' : 'bg-success') }} 
                                        fs-6 px-3 py-2">
                                        {{ $barang->stok }}
                                    </span>
                                    @if($barang->minimum_stok && $barang->stok <= $barang->minimum_stok)
                                        <br><small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Stok rendah</small>
                                    @endif
                                </td>
                                <td class="text-end py-3">
                                    <span class="fw-bold text-dark">Rp {{ number_format($barang->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="py-3">
                                    @if($barang->tanggal_masuk)
                                        <span class="text-muted">{{ $barang->tanggal_masuk }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info rounded-circle p-2 me-2">
                                            <i class="fas fa-user text-white" style="font-size: 0.7rem;"></i>
                                        </div>
                                        <span class="text-muted">{{ $barang->user?->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="text-center py-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('barangs.edit', $barang->id) }}" 
                                           class="btn btn-warning btn-sm px-3 rounded-2 fw-semibold"
                                           data-bs-toggle="tooltip" title="Edit Barang">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm px-3 rounded-2 fw-semibold"
                                                    onclick="return confirm('Yakin hapus barang {{ $barang->nama }}?')"
                                                    data-bs-toggle="tooltip" title="Hapus Barang">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada data barang</h5>
                                        <p class="text-muted mb-4">Mulai dengan menambahkan barang pertama Anda</p>
                                        <a href="{{ route('barangs.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Barang Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Table Footer --}}
        @if($barangs->hasPages())
            <div class="card-footer bg-transparent border-top-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Menampilkan {{ $barangs->firstItem() ?? 0 }} - {{ $barangs->lastItem() ?? 0 }} dari {{ $barangs->total() }} barang
                    </div>
                    {{ $barangs->links() }}
                </div>
            </div>
        @endif
    </div>

    {{-- Quick Actions --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card border-0 bg-light">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">
                        <i class="fas fa-bolt text-warning me-2"></i>Quick Actions
                    </h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('barangs.create') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Tambah Barang
                        </a>
                        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                            <i class="fas fa-print me-1"></i>Cetak Laporan
                        </button>
                        <button class="btn btn-outline-info btn-sm">
                            <i class="fas fa-download me-1"></i>Export Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 bg-light">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">
                        <i class="fas fa-chart-pie text-info me-2"></i>Statistik Cepat
                    </h6>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <div class="h5 mb-1 fw-bold text-primary">{{ $barangs->where('stok', 0)->count() }}</div>
                                <small class="text-muted">Stok Habis</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <div class="h5 mb-1 fw-bold text-warning">{{ $barangs->where('stok', '<=', 5)->count() }}</div>
                                <small class="text-muted">Stok Rendah</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <div class="h5 mb-1 fw-bold text-success">{{ $barangs->where('stok', '>', 10)->count() }}</div>
                                <small class="text-muted">Stok Aman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table td {
        border-color: #f8f9fa;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4361ee, #3a56d4);
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }

    .badge {
        font-size: 0.75rem;
        font-weight: 600;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Add confirmation for delete with sweet alert (optional enhancement)
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                const barangName = button.getAttribute('onclick')?.match(/barang (.+?)\?/)?.[1] || 'ini';
                
                if (!confirm(`Yakin menghapus barang ${barangName}? Tindakan ini tidak dapat dibatalkan.`)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection