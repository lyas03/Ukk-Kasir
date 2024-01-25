<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MejaM;
use App\Models\ProdukM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardC extends Controller
{
    public function dashboard()
    {
        $totalProducts = ProdukM::count();
        $totalMeja = MejaM::count();
        $totalUsers = User::count();

        return view('/content/dashboard', compact('totalProducts', 'totalMeja', 'totalUsers'));
    }
}
