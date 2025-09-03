<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Menampilkan dashboard dengan chart stok berdasarkan tanggal masuk
     */
    public function index()
    {
        $query = Barang::select(
                DB::raw('DATE(tanggal_masuk) as tanggal'),
                DB::raw('SUM(stok) as total_stok')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc');

        // Kalau bukan admin, filter berdasarkan user login
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $chartData = $query->get();

        // Format data untuk Chart.js
        $labels = $chartData->pluck('tanggal');
        $values = $chartData->pluck('total_stok');

        return view('dashboard', compact('labels', 'values'));
    }
}
