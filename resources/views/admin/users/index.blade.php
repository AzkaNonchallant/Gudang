@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Manajemen User</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="table-responsive">
<table class="table table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th style="width: 5%">#</th>
            <th>Nama</th>
            <th>Email</th>
            <th style="width: 12%">Role</th>
            <th style="width: 20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $i => $user)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><span class="badge bg-secondary">{{ strtoupper($user->role) }}</span></td>
            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus user {{ $user->name }}?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Belum ada user.</td></tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
