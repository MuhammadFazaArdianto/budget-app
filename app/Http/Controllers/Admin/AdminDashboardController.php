<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function user()
    {
        $users = User::latest()->get();
        return view('admin.dashboard.user', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        try{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            Alert::success('Berhasil', 'Data pengguna berhasil disimpan.');
            return redirect()->back();
        }catch(\Exception $e){
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan data pengguna: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'sometimes|string',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6',
            ]);

            $data = $request->only(['name', 'email']);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);
            Alert::success('Berhasil', 'Data pengguna berhasil diperbarui.');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui data pengguna: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            Alert::success('Berhasil', 'Data pengguna berhasil dihapus.');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data pengguna: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
