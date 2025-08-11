<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function prosesLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard() {
        $data = User::where('id', Auth::user()->id)
            ->with('pimpinan', 'dokter', 'kasir', 'pasien')
            ->first();

        $lengkapiDataAkun = isset($data->pasien) || isset($data->dokter) || isset($data->kasir) || isset($data->pimpinan);
//        dd($lengkapiDataAkun);
        return view('dashboard', compact('lengkapiDataAkun'));
    }

    public function pendaftaranAkun() {
        return view('auth.register');
    }

    public function prosesDaftar(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);
        DB::beginTransaction();
        try {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            DB::commit();
            return redirect()->route('login')->with('success', "akun {$user->username} berhasil dibuat, silakan login");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal membuat akun: ' . $e->getMessage()]);
        }
    }
}
