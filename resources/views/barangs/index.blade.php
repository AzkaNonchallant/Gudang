@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Barang</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('barangs.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Tanggal Masuk</th>
                <th>Diunggah Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $barang)
                <tr>
                    <td>{{ $barang->kode }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                    <td>{{ $barang->tanggal_masuk }}</td>
                    <td>{{ $barang->user?->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
