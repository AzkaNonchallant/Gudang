<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Tampilkan semua user (khusus admin).
     */
    public function index()
    {
        // Ambil semua user + hitung jumlah barang yang diupload
        $users = User::withCount('barangs')->get();

        return view('admin.users.index', compact('users'));
    }
}
