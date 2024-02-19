<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MejaM;
use App\Models\ProdukM;
use App\Models\KategoriM;
use App\Models\TransaksiM;
use Illuminate\Http\Request;
use App\Models\DetailTransaksiM;
use Illuminate\Support\Facades\Auth;

class DashboardC extends Controller
{
    public function dashboard()
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the authenticated user
            $userRole = Auth::user()->role;

            // Count total products, meja, and users
            $totalProducts = ProdukM::count();
            $totalMeja = MejaM::count();
            $totalUsers = User::count();
            $totalKategori = KategoriM::count();
            $totalTransaksi = TransaksiM::count();
            $pendapatan = TransaksiM::sum('sub_total');
            $product = ProdukM::all();

            // Pass the userRole variable to the view
            return view('/content/dashboard', compact('totalProducts','pendapatan','product', 'totalMeja', 'totalUsers', 'userRole','totalTransaksi','totalKategori'));
        }

        // Redirect to login if the user is not authenticated
        return redirect()->route('login');
    }
}
