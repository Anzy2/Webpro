<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Halaman login
    public function login()
    {
        return view('login');
    }

    // 2. Proses login
    public function auth(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect('/home');
        } else {
            return back()->with('error', 'Email atau password salah!');
        }
    }

    // 3. Halaman registrasi
    public function registration()
    {
        return view('registration');
    }

    // 4. Proses register
    public function register(Request $request)
    {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Registrasi berhasil!');
    }

    // 5. Halaman home
    public function home()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('home', [
            'user' => Auth::user()
        ]);
    }

    // 6. Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}