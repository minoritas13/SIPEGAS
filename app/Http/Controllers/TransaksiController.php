<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = DetailTransaksi::with('user');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            // Filter berdasarkan tanggal dari form
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        } else {
            // Default: filter bulan ini
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }

        $transaksi = $query->orderBy('created_at', 'desc')->get();

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
            'status_pembayaran' => false,
        ]);

        $barang->stok_isi -= $validated['jumlah'];
        $barang->save();

        return redirect()->route('dashboardUser')->with('success', 'Transaksi berhasil!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:detail_transaksi,id',
            'status_pembayaran' => 'required|boolean'
        ]);

        $transaksi = DetailTransaksi::findOrFail($request->id);
        $transaksi->status_pembayaran = $request->status_pembayaran;
        $transaksi->save();

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
