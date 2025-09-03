@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit User</div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="form-control" minlength="6" placeholder="••••••">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    @foreach($roles as $r)
                        <option value="{{ $r }}" @selected(old('role', $user->role) === $r)>{{ ucfirst($r) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
