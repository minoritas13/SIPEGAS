<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $transaksi = DetailTransaksi::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        return view('transaksi', [
            'title' => 'Transaksi',
            'transaksi' => $transaksi
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
            'pembeli' => 'required|string|max:100',
            'created_at' => 'required|date'
        ]);

        $barang = Barang::first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak tersedia.');
        }

        if ($validated['jumlah'] > $barang->stok_isi) {
            return redirect()->route('dashboardUser')->with('error', 'Stok barang tidak mencukupi.');
        }

        // Hitung total
        $total = $validated['jumlah'] * $barang->harga;

        // Simpan transaksi
        DetailTransaksi::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'jumlah' => $validated['jumlah'],
            'total' => $total,
            'pembeli' => $validated['pembeli'],
            'created_at' => $validated['created_at'],
        ]);

        $barang->stok_isi -= $validated['jumlah'];
        $barang->save();

        return redirect()->route('dashboardUser')->with('success', 'Transaksi berhasil!');
    }
}
