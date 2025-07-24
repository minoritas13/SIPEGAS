<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailTransaksi;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'Harian');

        $today = Carbon::now();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        switch ($filter) {
            case 'Mingguan':
                $start = $startOfWeek;
                $end = $endOfWeek;
                $groupBy = 'Y-m-d';
                break;
            case 'Bulanan':
                $start = $startOfYear; // seluruh tahun ini
                $end = $endOfYear;
                $groupBy = 'Y-m'; // grup per bulan
                break;
            case 'Tahunan':
                $start = Carbon::now()->subYears(4)->startOfYear(); // 5 tahun terakhir
                $end = $endOfYear;
                $groupBy = 'Y'; // grup per tahun
                break;
            default: // Harian
                $start = $today->copy()->startOfDay();
                $end = $today->copy()->endOfDay();
                $groupBy = 'Y-m-d';
                break;
        }

        $transaksi = DetailTransaksi::whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy(function ($item) use ($groupBy) {
                return Carbon::parse($item->created_at)->format($groupBy);
            })
            ->map(function ($group, $key) {
                return [
                    'tanggal' => $key,
                    'jumlah' => $group->sum('jumlah'),
                    'total' => $group->sum('total')
                ];
            })
            ->values();

        $total = $transaksi->sum('total');

        return view('laporanPenjualan', compact('transaksi', 'filter', 'total'));
    }
}
