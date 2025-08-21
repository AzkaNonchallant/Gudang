@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Barang</h3>
    <a href="{{ route('barangs.create') }}" class="btn btn-primary">+ Tambah Barang</a>
</div>

@php
    $lowStok = $barangs->filter(function($b){ return $b->stok < $b->minimum_stok; });
@endphp

@if($lowStok->isNotEmpty())
    <div class="alert alert-danger">
        <strong>⚠️ Ada barang dengan stok menipis:</strong>
        <ul class="mb-0">
            @foreach($lowStok as $b)
                <li>{{ $b->kode }} — {{ $b->nama }} (stok: {{ $b->stok }}, minimum: {{ $b->minimum_stok }})</li>
            @endforeach
        </ul>
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Minimum</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangs as $barang)
        <tr class="{{ $barang->stok < $barang->minimum_stok ? 'table-danger' : '' }}">
            <td>{{ $barang->kode }}</td>
            <td>{{ $barang->nama }}</td>
            <td>{{ $barang->stok }}</td>
            <td>{{ $barang->minimum_stok }}</td>
            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('barangs.edit', $barang) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('barangs.destroy', $barang) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin mau hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
