<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginFunction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                
                $user = Auth::user();
                // dd($user); 
    
                if ($user->role === 'admin') {
                    Alert::success('Login Berhasil', 'Selamat datang di dashboard admin!');
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === 'user') {
                    Alert::success('Login Berhasil', 'Selamat datang di dashboard pengguna!');
                    return redirect()->route('user.dashboard');
                } else {
                    Auth::logout(); 
                    Alert::error('Login Gagal', 'Role tidak dikenali.');
                    return back();
                }
            } else {
                Alert::error('Login Gagal', 'Email atau password salah. Silakan coba lagi.');
                return back();
            }
        } catch (\Exception $e) {
            Alert::error('Kesalahan', 'Terjadi kesalahan saat login: ' . $e->getMessage());
            return back();
        }
    }

    public function registerFunction(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try{
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'user',
            ]);
            Alert::success('Registrasi Berhasil', 'Silakan login dengan akun Anda.');
            return redirect()->route('login');
        }catch(\Exception $e) {
            Alert::error('Kesalahan', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage());
            return back();
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            Alert::success('Logout Berhasil', 'Anda telah berhasil logout.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Alert::error('Logout Gagal', 'Terjadi kesalahan saat logout: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
