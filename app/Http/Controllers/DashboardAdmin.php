<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notes;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class DashboardAdmin extends Controller
{
    public function index()
    {
        $barangData = Barang::first();
        $barang = $barangData->stok_isi;
        $stok_bocor = $barangData->stok_bocor;

        $totalHariIni = DetailTransaksi::whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->count();

        $totalBulanIni = DetailTransaksi::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total');

        $notes = Notes::latest()->take(2)->pluck('notes');

        if (Auth::user()->is_admin) {
            return view('dashboardAdmin', [
                'success' => 'selamat datang',
                'barang' => $barang,
                'totalHariIni' => $totalHariIni,
                'totalBulanIni' => $totalBulanIni,
                'stok_bocor' => $stok_bocor,
                'notes' => $notes
            ]);
        }

        return redirect()->route('dashboardUser');
    }
}
