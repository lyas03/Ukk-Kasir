<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MejaM;
use App\Models\ProdukM;
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
            $totalTransaksi = TransaksiM::count();
            $transaction = TransaksiM::all();
            $transactions = DetailTransaksiM::with(['transaksi', 'produk'])
            ->select('id_transaction', 'id_produk', 'jumlah','total_harga')
            ->orderBy('created_at', 'desc')
            ->get();

            // Pass the userRole variable to the view
            return view('/content/dashboard', compact('totalProducts','transaction','transactions', 'totalMeja', 'totalUsers', 'userRole','totalTransaksi'));
        }

        // Redirect to login if the user is not authenticated
        return redirect()->route('login');
    }
}
