<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'notes' => 'required|string|max:255',
        ]);

        // Simpan catatan
        Notes::create([
            'user_id' => Auth::id(),
            'notes' => $request->notes,
        ]);

        // Redirect ke dashboard sesuai role
        $redirectRoute = Auth::user()->is_admin ? 'dashboardAdmin' : 'dashboardUser';

        return redirect()->route($redirectRoute)->with('success', 'Catatan berhasil ditambahkan!');
    }
}
