@extends('layouts.app')

@section('content')
<h2 class="mb-3">Tambah User</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST" class="card card-body">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required minlength="6">
    </div>

    <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select" required>
            @foreach($roles as $r)
                <option value="{{ $r }}" @selected(old('role')===$r)>{{ ucfirst($r) }}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
