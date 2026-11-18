<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
    return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])
            ->where('role', 'admin')
            ->first();

        if (!$user || !Hash::check(
            $credentials['password'],
            $user->password
        )) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah.');
        }

        $request->session()->regenerate();

        $request->session()->put([
            'admin_id' => $user->id,
            'admin_name' => $user->name,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Login berhasil. Selamat datang!');
    }

    public function logout(Request $request)
    {
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('home')
        ->with('success', 'Anda berhasil logout.');
    }
}
