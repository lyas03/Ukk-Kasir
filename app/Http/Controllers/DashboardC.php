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
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the authenticated user
            $userRole = Auth::user()->role;

            // Count total products, meja, and users
            $totalProducts = ProdukM::count();
            $totalMeja = MejaM::count();
            $totalUsers = User::count();

            // Pass the userRole variable to the view
            return view('/content/dashboard', compact('totalProducts', 'totalMeja', 'totalUsers', 'userRole'));
        }

        // Redirect to login if the user is not authenticated
        return redirect()->route('login');
    }
}
