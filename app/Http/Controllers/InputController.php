<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputController extends Controller
{
    public function index()
    {
        return view('input', [
            'title' => 'Input Barang',
            'cek' => Auth::user()->username,
        ]);
    }

    public function update(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'stok_isi' => ['required', 'integer', 'min:1'],
            'stok_bocor' => ['nullable', 'integer', 'min:0'],
        ]);

        // Ambil barang pertama
        $barang = Barang::first();

        if (!$barang) {
            return redirect()->back()->withErrors(['Barang belum tersedia.']);
        }

        // Hitung stok kosong
        $stok_kosong = max(200 - $validated['stok_isi'], 0); // jaga-jaga agar tidak negatif

        // Update data barang
        $barang->update([
            'user_id' => Auth::id(),
            'stok_isi' => $validated['stok_isi'],
            'stok_bocor' => $validated['stok_bocor'] ?? null,
            'stok_kosong' => $stok_kosong,
            'harga' => 20000,
        ]);

        return redirect()->route('dashboardAdmin')->with('success', 'Barang berhasil diperbarui.');
    }
}
