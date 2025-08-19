<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AkunController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('akun.index', compact('users'));
    }

    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // pastikan ada input password_confirmation
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Login otomatis
        Auth::login($user);

        // Redirect ke home
        return redirect('/home')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'kontak' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
            'kontak' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->kontak = $request->kontak;
        $user->alamat = $request->alamat;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);

        // Pastikan tidak menghapus akun sendiri
        if ($user->id == auth()->id()) {
            return response()->json(['error' => 'Tidak bisa menghapus akun sendiri'], 403);
        }

        $user->delete();

        return response()->json(['success' => true]);
    }
}
