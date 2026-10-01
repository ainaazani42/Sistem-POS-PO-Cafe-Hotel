<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([...$credentials, 'role' => 'admin'])) {
            $request->session()->regenerate();

            return redirect()->route('admin.menu.index');
        }

        return back()->withErrors([
            'email' => 'Email, password, atau akses admin tidak valid.',
        ])->onlyInput('email');
    }

    public function showAdminRegister()
    {
        return view('auth.admin-register');
    }

    public function adminRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.menu.index')->with('success', 'Akun admin berhasil dibuat.');
    }

    public function showUserLogin()
    {
        return redirect()->to(route('landing').'#akses');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([...$credentials, 'role' => 'pelanggan'])) {
            $request->session()->regenerate();

            return redirect()->intended(route('siswa.dashboard'));
        }

        return back()->withErrors(['user_login' => 'Email atau password user tidak valid.'])->withInput();
    }

    public function userRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:50', 'unique:users,nis'],
            'kelas' => ['nullable', 'string', 'max:100'],
            'no_whatsapp' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $user = User::create([...$validated, 'role' => 'pelanggan']);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('siswa.dashboard')->with('success', 'Akun user berhasil dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
