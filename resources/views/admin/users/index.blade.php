@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar User</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Total Barang Upload</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ $user->barangs_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
