<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class DashboardAdmin extends Controller
{
    public function index(){
        return view('dashboardAdmin' , ['title' => 'Dashboard Admin']);
    }
}
