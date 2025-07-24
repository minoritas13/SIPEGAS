<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Notes;

class DashboardUser extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cegah admin masuk dashboard user
        if ($user->is_admin) {
            return redirect()->route('dashboardAdmin');
        }

        // Ambil data barang sekali
        $barang = Barang::first();
        $stokIsi = $barang?->stok_isi ?? 0;

        // Ambil 2 catatan terbaru saja
        $notes = Notes::latest()
            ->limit(2)
            ->pluck('notes');

        return view('dashboardUser', [
            'title' => 'Dashboard user',
            'barang' => $stokIsi,
            'notes' => $notes,
        ]);
    }
}
