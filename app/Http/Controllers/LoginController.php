<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('welcome', ['title' => 'Login']); // View akan disimpan di resources/views/auth/login.blade.php
    }

    // (Nanti) proses login - di sini belum dipakai
    public function login(Request $request)
    {
         $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login menggunakan Auth
        if (Auth::attempt($credentials)) {
            // Regenerasi session
            $request->session()->regenerate();

            return redirect()->route('DashboardAdmin');
        }

        // Jika gagal login
        return redirect()->route('home')->with('error', 'Login gagal! password atau email salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}