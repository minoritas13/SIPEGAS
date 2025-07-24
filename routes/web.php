<?php

use App\Http\Middleware\isLogin;
use App\View\Components\Forms\Input;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardUser;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\InputController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/', [LoginController::class, 'login']);

Route::get('/login',[LoginController::class, 'logout'])->name('logout');

Route::middleware([isLogin::class])->group(function () {
    Route::get('/dashboardAdmin', [DashboardAdmin::class, 'index'])->name('dashboardAdmin');
    Route::get('/dashboardUser', [DashboardUser::class, 'index'])->name('dashboardUser');

    Route::get('/input', [InputController::class, 'index'])->name('showInputBarang');
    Route::put('/input', [InputController::class, 'update'])->name('inputBarang');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('showTransaksi');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('TransaksiBarang');

    Route::post('/notes', [NotesController::class, 'store'])->name('CreateNotes');

    Route::get('/laporanPenjualan', [LaporanPenjualanController::class, 'index'])->name('showLaporan');
    Route::get('/filter', [LaporanPenjualanController::class, 'index'])->name('filter');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::delete('/pengguna/{user}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});
