<?php

use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\isLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');
Route::post('/', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboardAdmin', [DashboardAdmin::class, 'index'])->middleware(isLogin::class)->name('DashboardAdmin');
