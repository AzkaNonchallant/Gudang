<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Tampilkan daftar barang
     */
    public function index()
    {
        $barangs = Barang::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('barangs.index', compact('barangs'));
    }

    /**
     * Form tambah barang
     */
    public function create()
    {
        return view('barangs.create');
    }

    /**
     * Simpan barang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'minimum_stok' => 'nullable|integer|min:1',
            'tanggal_masuk' => 'nullable|date',
        ]);

        Barang::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'minimum_stok' => $request->minimum_stok ?? 1,
            'tanggal_masuk' => $request->tanggal_masuk,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail barang
     */
    public function show(Barang $barang)
    {
        $this->authorizeBarang($barang);

        return view('barangs.show', compact('barang'));
    }

    /**
     * Form edit barang
     */
    public function edit(Barang $barang)
    {
        $this->authorizeBarang($barang);

        return view('barangs.edit', compact('barang'));
    }

    /**
     * Update barang
     */
    public function update(Request $request, Barang $barang)
    {
        $this->authorizeBarang($barang);

        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'minimum_stok' => 'nullable|integer|min:1',
            'tanggal_masuk' => 'nullable|date',
        ]);

        $barang->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'minimum_stok' => $request->minimum_stok ?? 1,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Hapus barang
     */
    public function destroy(Barang $barang)
    {
        $this->authorizeBarang($barang);

        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Pastikan barang hanya bisa diakses oleh pemiliknya
     */
    private function authorizeBarang(Barang $barang)
    {
        if ($barang->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
