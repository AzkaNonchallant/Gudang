@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        {{-- Header Section --}}
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <div class="bg-primary rounded-circle p-3 text-white">
                    <i class="fas fa-cube fa-lg"></i>
                </div>
            </div>
            <div>
                <h2 class="h3 mb-1 fw-bold text-primary">Tambah Barang Baru</h2>
                <p class="text-muted mb-0">Isi form berikut untuk menambahkan barang ke inventory</p>
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
                    <i class="fas fa-edit me-2 text-primary"></i>Form Tambah Barang
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('barangs.store') }}" method="POST" id="barangForm">
                    @csrf

                    {{-- Kode Barang --}}
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
                                       value="{{ old('kode') }}"
                                       placeholder="Masukkan kode barang...">
                                <div class="form-text text-muted small">
                                    Kode unik untuk identifikasi barang
                                </div>
                            </div>
                        </div>

                        {{-- Nama Barang --}}
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tag me-2 text-muted"></i>Nama Barang
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('nama') }}" 
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
                                    <i class="fas fa-boxes me-2 text-muted"></i>Stok Awal
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       name="stok" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('stok') }}" 
                                       required
                                       min="0"
                                       placeholder="0">
                                <div class="form-text text-muted small">
                                    Jumlah stok awal barang
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
                                           value="{{ old('harga') }}" 
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
                                       value="{{ old('minimum_stok', 1) }}"
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
                                <input type="date" 
                                       name="tanggal_masuk" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3" 
                                       value="{{ old('tanggal_masuk') }}">
                                <div class="form-text text-muted small">
                                    Tanggal barang masuk ke inventory
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-lg px-4 rounded-3 fw-semibold">
                            <i class="fas fa-save me-2"></i>Simpan Barang
                        </button>
                        <a href="{{ route('barangs.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-3 fw-semibold">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Quick Tips --}}
        <div class="card border-0 bg-light mt-4">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-3">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Tips Pengisian
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled small text-muted mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Pastikan kode barang unik
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Isi stok dengan angka positif
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled small text-muted mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Harga menggunakan format angka
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Minimum stok untuk peringatan
                            </li>
                        </ul>
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

    .form-control {
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        border-color: #4361ee;
        background-color: #fff;
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

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: none;
        font-weight: 500;
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
        const form = document.getElementById('barangForm');
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
                    // Show toast or alert for missing fields
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

        // Set default date to today if empty
        const tanggalInput = document.querySelector('input[name="tanggal_masuk"]');
        if (tanggalInput && !tanggalInput.value) {
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.value = today;
        }
    });
</script>
@endsection