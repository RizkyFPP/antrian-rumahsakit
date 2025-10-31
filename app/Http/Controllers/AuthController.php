<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * 🔹 Tampilkan form login
     */
    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect('/loket/' . auth()->user()->loket);
        }

        return view('auth.login');
    }

    /**
     * 🔹 Proses login menggunakan username & password (MD5)
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek user berdasarkan username
        $user = DB::table('users')->where('username', $request->username)->first();

        if ($user && $user->password === md5($request->password)) {
            // Simpan session login
            Auth::loginUsingId($user->id);

            // Arahkan ke halaman loket sesuai nomor loket user
            return redirect()->route('loket.index', ['loket' => $user->loket]);
        }

        // Jika gagal login
        return back()->withErrors([
            'username' => 'Username atau password salah!',
        ])->withInput();
    }

    /**
     * 🔹 Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
