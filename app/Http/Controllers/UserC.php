<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserC extends Controller
{
    public function users()
    {
        $users = User::all();
        $user = new User();
        $roles = $user->getEnumRoles();

        return view('User.user', compact('users', 'roles'));
    }
    public function addUserForm()
    {
        $user = new User();
        $roles = $user->getEnumRoles(); 

        return view('User.add-user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $user = new User;

        try {
            $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required',
                'role' => [
                    'required',
                    Rule::in($user->getEnumRoles()),
                ],
            ]);

            User::create([
                'nama' => $request->input('nama'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
            ]);

            return redirect()->route('users')->with('success', 'Berhasil Menambahkan User');
        } catch (ValidationException $e) {
            // Tangkap kesalahan validasi
            return redirect()->route('users')->with('error', 'Gagal Menambahkan User, Username sudah ada.');
        } catch (Exception $e) {
            // Tangkap kesalahan umum
            return redirect()->route('users')->with('error', 'Gagal menambahkan user, Mohon Coba Lagi');
        }
    }

    public function edit($id)
    {
        // Fetch the user by ID from the database
        $user = User::findOrFail($id);

        // Fetch roles from the user model method
        $roles = $user->getEnumRoles();

        return view('User.edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users,username,'.$id,
                'role' => [
                    'required',
                    Rule::in((new User())->getEnumRoles()),
                ],
            ]);

            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('users')->with('success', 'Berhasil Update User');
        } catch (ValidationException $e) {
            // Tangkap kesalahan validasi
            return redirect()->route('users')->with('error', 'Gagal Update User. Username sudah ada');
        } catch (\Exception $e) {
            // Tangkap kesalahan umum
            return redirect()->route('users')->with('error', 'Gagal Update User, Mohon Coba Lagi');
        }
    }
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users')->with('success', 'Berhasil Hapus User');
        } catch (\Exception $e) {
            return redirect()->route('users')->with('error', 'Gagal Hapus User, Mohon Coba Lagi');
        }
    }
    public function printUsers()
    {
        $users = User::all();

        // Generate PDF
        $pdf = PDF::loadView('User.print-user', compact('users'));

        // Download the PDF or display it in the browser using 'stream'
        return $pdf->stream('user.pdf');
    }
    public function changePassword(Request $request, $id){
        try {
            $request->validate([
                'password_new' => 'required',
                'password_confirm' => 'required|same:password_new',
            ]);

            $user = User::findOrFail($id);
    
            $user->update([
                'password' => Hash::make($request->password_new),
            ]);
    
            return redirect()->route('users')->with('success', 'Password Berhasil Diperbaharui!');
        } catch (\Exception $e) {
            // Tangani kesalahan lainnya di sini
            return redirect()->route('users')->with('error', 'Password baru dan password confirm tidak sama');
        }
    }
}