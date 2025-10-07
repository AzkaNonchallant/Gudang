@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        {{-- Header Section --}}
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <div class="bg-warning rounded-circle p-3 text-white">
                    <i class="fas fa-edit fa-lg"></i>
                </div>
            </div>
            <div>
                <h2 class="h3 mb-1 fw-bold text-dark">Edit Barang</h2>
                <p class="text-muted mb-0">Perbarui informasi barang yang sudah ada</p>
            </div>
        </div>

        {{-- Current Item Info --}}
        <div class="card border-0 bg-light mb-4">
            <div class="card-body p-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="fw-semibold mb-1">Barang Saat Ini</h6>
                        <p class="text-muted mb-0 small">
                            <span class="fw-semibold">{{ $barang->nama }}</span> 
                            @if($barang->kode)
                                • Kode: {{ $barang->kode }}
                            @endif
                            • Stok: {{ $barang->stok }} • Harga: Rp {{ number_format($barang->harga, 2) }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        @php
                            // Safe way to display updated_at timestamp
                            $updatedAt = $barang->updated_at instanceof \Carbon\Carbon 
                                ? $barang->updated_at->diffForHumans() 
                                : 'Unknown';
                        @endphp
                        <span class="badge bg-primary">Terakhir diupdate: {{ $updatedAt }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    <h6 class="fw-bold mb-0">Terjadi Kesalahan</h6>
                </div>
                <ul class="mb-0 mt-2 ps-3">
                    @foreach ($errors->all() as $err)
                        <li class="small">{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom-0 py-4">
                <h5 class="card-title mb-0 fw-semibold text-dark">
                    <i class="fas fa-pencil-alt me-2 text-warning"></i>Form Edit Barang
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('barangs.update', $barang->id) }}" method="POST" id="editBarangForm">
                    @csrf
                    @method('PUT')

                    {{-- Kode Barang & Nama Barang --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-barcode me-2 text-muted"></i>Kode Barang
                                    <span class="text-muted small">(Opsional)</span>
                                </label>
                                <input type="text" 
                                       name="kode" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('kode', $barang->kode) }}"
                                       placeholder="Masukkan kode barang...">
                                <div class="form-text text-muted small">
                                    Kode unik untuk identifikasi barang
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tag me-2 text-muted"></i>Nama Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('nama', $barang->nama) }}" 
                                       required
                                       placeholder="Masukkan nama barang...">
                                <div class="form-text text-muted small">
                                    Nama lengkap barang
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Stok & Harga --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-boxes me-2 text-muted"></i>Stok
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       name="stok" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('stok', $barang->stok) }}" 
                                       required
                                       min="0"
                                       placeholder="0">
                                <div class="form-text text-muted small">
                                    Jumlah stok saat ini
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-money-bill-wave me-2 text-muted"></i>Harga
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light">Rp</span>
                                    <input type="number" 
                                           step="0.01" 
                                           name="harga" 
                                           class="form-control form-control-lg border-0 bg-light rounded-end-3" 
                                           value="{{ old('harga', $barang->harga) }}" 
                                           required
                                           min="0"
                                           placeholder="0.00">
                                </div>
                                <div class="form-text text-muted small">
                                    Harga satuan barang
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Minimum Stok & Tanggal Masuk --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-exclamation-triangle me-2 text-muted"></i>Minimum Stok
                                </label>
                                <input type="number" 
                                       name="minimum_stok" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('minimum_stok', $barang->minimum_stok) }}"
                                       min="1"
                                       placeholder="1">
                                <div class="form-text text-muted small">
                                    Stok minimum sebelum peringatan
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-2 text-muted"></i>Tanggal Masuk
                                </label>
                                @php
                                    // Safe date handling - check if it's a Carbon object or string
                                    $tanggalMasukValue = old('tanggal_masuk', $barang->tanggal_masuk);
                                    
                                    // If it's a Carbon instance, format it, otherwise use as-is
                                    if ($tanggalMasukValue instanceof \Carbon\Carbon) {
                                        $tanggalMasukValue = $tanggalMasukValue->format('Y-m-d');
                                    } elseif (is_string($tanggalMasukValue) && !empty($tanggalMasukValue)) {
                                        // If it's already a string in Y-m-d format, use it directly
                                        // Otherwise, you might want to convert it here if needed
                                        $tanggalMasukValue = $tanggalMasukValue;
                                    } else {
                                        $tanggalMasukValue = '';
                                    }
                                @endphp
                                <input type="date" 
                                       name="tanggal_masuk" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ $tanggalMasukValue }}">
                                <div class="form-text text-muted small">
                                    Tanggal barang masuk ke inventory
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-warning btn-lg px-4 rounded-3 fw-semibold text-white">
                            <i class="fas fa-save me-2"></i>Update Barang
                        </button>
                        <a href="{{ route('barangs.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-3 fw-semibold">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-lg px-4 rounded-3 fw-semibold ms-auto" 
                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Changes Summary --}}
        <div class="card border-0 bg-light mt-4">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-3">
                    <i class="fas fa-history text-info me-2"></i>Riwayat Barang
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled small text-muted mb-0">
                            <li class="mb-2">
                                <i class="fas fa-calendar-plus text-success me-2"></i>
                                @php
                                    $createdAt = $barang->created_at instanceof \Carbon\Carbon 
                                        ? $barang->created_at->format('d M Y H:i') 
                                        : 'Unknown';
                                @endphp
                                Dibuat: {{ $createdAt }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-user text-primary me-2"></i>
                                ID Barang: #{{ $barang->id }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled small text-muted mb-0">
                            <li class="mb-2">
                                <i class="fas fa-calendar-check text-warning me-2"></i>
                                @php
                                    $updatedAt = $barang->updated_at instanceof \Carbon\Carbon 
                                        ? $barang->updated_at->format('d M Y H:i') 
                                        : 'Unknown';
                                @endphp
                                Terakhir diupdate: {{ $updatedAt }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock text-info me-2"></i>
                                @php
                                    $lastUpdate = $barang->updated_at instanceof \Carbon\Carbon 
                                        ? $barang->updated_at->diffForHumans() 
                                        : 'Unknown';
                                @endphp
                                {{ $lastUpdate }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus barang <strong>"{{ $barang->nama }}"</strong>?</p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Barang</button>
                </form>
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

    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.15);
        border-color: #ffc107;
        background-color: #fff;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        border: none;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: none;
        font-weight: 500;
    }

    .badge {
        font-size: 0.75rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-format currency input
        const hargaInput = document.querySelector('input[name="harga"]');
        if (hargaInput) {
            hargaInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        }

        // Form validation enhancement
        const form = document.getElementById('editBarangForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let valid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    // Show toast for missing fields
                    const toast = document.createElement('div');
                    toast.className = 'alert alert-danger position-fixed top-0 end-0 m-4';
                    toast.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Harap isi semua field yang wajib diisi';
                    document.body.appendChild(toast);
                    
                    setTimeout(() => {
                        toast.remove();
                    }, 3000);
                }
            });
        }

        // Show changes warning
        const inputs = form.querySelectorAll('input');
        let originalValues = {};
        
        inputs.forEach(input => {
            originalValues[input.name] = input.value;
        });

        form.addEventListener('submit', function(e) {
            let hasChanges = false;
            inputs.forEach(input => {
                if (originalValues[input.name] !== input.value) {
                    hasChanges = true;
                }
            });

            if (!hasChanges) {
                e.preventDefault();
                const toast = document.createElement('div');
                toast.className = 'alert alert-info position-fixed top-0 end-0 m-4';
                    toast.innerHTML = '<i class="fas fa-info-circle me-2"></i>Tidak ada perubahan yang dilakukan';
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }
        });
    });
</script>
@endsection