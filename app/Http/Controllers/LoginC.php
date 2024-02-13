<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\LogM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginC extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->role == 'admin' || $user->role == 'kasir') {
                LogM::create([
                    'id_user' => $user->id,
                    'activity' => "{$user->role} Melakukan Login",
                ]);
            }
    
            // Arahkan semua peran ke halaman dashboard
            return redirect('/dashboard');
        }

        // Jika autentikasi gagal, set session error dan kembalikan ke halaman login
        return redirect('/login')->withInput($request->only('username'))
            ->with(['login' => 'Email atau password salah']);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($user->role == 'admin' || $user->role == 'kasir') {
            LogM::create([
                'id_user' => $user->id,
                'activity' => "{$user->role} Melakukan Logout",
            ]);
        }

        return redirect('login');
    }
    
}
