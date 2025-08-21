<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Menampilkan dashboard dengan chart stok berdasarkan tanggal masuk
     */
    public function index()
    {
        // Ambil data stok barang per tanggal masuk
        $chartData = Barang::select(
                DB::raw('DATE(tanggal_masuk) as tanggal'),
                DB::raw('SUM(stok) as total_stok')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Format data untuk Chart.js
        $labels = $chartData->pluck('tanggal');
        $values = $chartData->pluck('total_stok');

        return view('dashboard', compact('labels', 'values'));
    }
}
