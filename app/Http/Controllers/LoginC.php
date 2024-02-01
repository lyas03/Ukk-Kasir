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

            switch ($user->role) {
                case 'admin':
                    LogM::create([
                        'id_user' => $user->id,
                        'activity' => "Admin Melakukan Login",
                    ]);
                    return redirect('/dashboard');
                case 'kasir':
                    LogM::create([
                        'id_user' => $user->id,
                        'activity' => "Kasir Melakukan Login",
                    ]);
                    return redirect('/transaksi');
                case 'owner':
                    LogM::create([
                        'id_user' => $user->id,
                        'activity' => "Owner Melakukan Login",
                    ]);
                    return redirect('/log');
                default:
                    return redirect('/login');
            }
        }

        return redirect('/login')->withInput($request->only('username'))
            ->withErrors(['login' => 'Email atau password salah']);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        LogM::create([
            'id_user' => $user->id,
            'activity' => "{$user->role} Melakukan Logout",
        ]);

        return redirect('login');
    }
}
