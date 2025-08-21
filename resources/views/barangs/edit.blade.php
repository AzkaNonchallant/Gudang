@extends('layouts.app')

@section('content')
<h3>Edit Barang</h3>

<form action="{{ route('barangs.update', $barang) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $barang->nama) }}" required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>
    </div>

    <div class="mb-3">
        <label>Minimum Stok</label>
        <input type="number" name="minimum_stok" class="form-control" value="{{ old('minimum_stok', $barang->minimum_stok) }}" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ old('harga', $barang->harga) }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
