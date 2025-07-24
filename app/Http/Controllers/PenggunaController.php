<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'is_admin' => false,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('pengguna')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('pengguna')->with('success', 'User berhasil dihapus.');
    }
}
