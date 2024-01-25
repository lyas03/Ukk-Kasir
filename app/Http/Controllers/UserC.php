<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserC extends Controller
{
    public function users ()
    {
        $users = User::all();

        return view('/User/user', compact('users'));
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => [
                'required',
                Rule::in($user->getEnumRoles()),
            ],
        ]);
    
        try {
            User::create([
                'nama' => $request->input('nama'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
            ]);
    
            return redirect()->route('users')->with('success', 'Berhasil Menambahkan User');
        } catch (\Exception $e) {
            return redirect()->route('users')->with('error', 'Gagal menambahkan user, Coba Lagi');
        }
    }
    public function edit($id)
    {
        // Fetch the user by ID from the database
        $user = User::findOrFail($id);

        // Fetch roles from your data source
        $roles = ['admin', 'kasir', 'owner']; // Replace with your actual roles

        return view('/User/edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'role' => 'required|string|unique:users,role,'.$id,
        ]);
        try{
            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('users')->with('success', 'Berhasil Update User');
        }  catch (\Exception $e) {
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
}
