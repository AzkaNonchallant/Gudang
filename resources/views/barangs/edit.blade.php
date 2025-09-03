@extends('layouts.app')

@section('content')
<h2 class="mb-3">Edit Barang</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('barangs.update', $barang->id) }}" method="POST" class="card card-body">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Kode Barang</label>
        <input type="text" name="kode" class="form-control" value="{{ old('kode', $barang->kode) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $barang->nama) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" step="0.01" name="harga" class="form-control" value="{{ old('harga', $barang->harga) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Minimum Stok</label>
        <input type="number" name="minimum_stok" class="form-control" value="{{ old('minimum_stok', $barang->minimum_stok) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $barang->tanggal_masuk ? $barang->tanggal_masuk->format('Y-m-d') : '') }}">
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
