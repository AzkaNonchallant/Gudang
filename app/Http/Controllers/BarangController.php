<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Mail\StokMenipisMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('user')->orderBy('id', 'desc')->get();
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        return view('barangs.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return back()->withErrors(['msg' => 'Kamu harus login dulu!']);
        }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'minimum_stok' => 'nullable|integer|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        // Generate kode otomatis (BRG001, BRG002, ...)
        $last = Barang::latest('id')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $kode = 'BRG' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $barang = Barang::create([
            'user_id' => Auth::id(), // simpan user yang upload
            'kode' => $kode,
            'nama' => $data['nama'],
            'stok' => $data['stok'],
            'harga' => $data['harga'],
            'minimum_stok' => $data['minimum_stok'] ?? 1,
            'tanggal_masuk' => $data['tanggal_masuk'],
        ]);

        if ($barang->stok < $barang->minimum_stok) {
            Mail::to(config('mail.admin_address', env('MAIL_ADMIN', 'admin@example.com')))
                ->send(new StokMenipisMail($barang));
        }

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'minimum_stok' => 'nullable|integer|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        $barang->update([
            'nama' => $data['nama'],
            'stok' => $data['stok'],
            'harga' => $data['harga'],
            'minimum_stok' => $data['minimum_stok'] ?? $barang->minimum_stok,
            'tanggal_masuk' => $data['tanggal_masuk'],
        ]);

        if ($barang->stok < $barang->minimum_stok) {
            Mail::to(config('mail.admin_address', env('MAIL_ADMIN', 'admin@example.com')))
                ->send(new StokMenipisMail($barang));
        }

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }
}
