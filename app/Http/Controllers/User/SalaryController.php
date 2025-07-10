<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SalariesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SalaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = SalariesModel::where('user_id', $user->id)
            ->latest('tgl_gajian')
            ->get();
        return view('user.salaries.index',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_gajian' => 'required|date',
            'total_gaji' => 'required|numeric|min:0',
        ]);

        try {
            $user = Auth::user();
            SalariesModel::create([
                'user_id' => $user->id,
                'tgl_gajian' => $request->tgl_gajian,
                'total_gaji' => $request->total_gaji,
            ]);

            Alert::success('Berhasil', 'Data salari berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_gajian' => 'sometimes|date',
            'total_gaji' => 'sometimes|numeric|min:0',
        ]);

        try {
            $user = Auth::user();
            $salary = SalariesModel::where('id', $id)
                ->where('user_id', $user->id)
                ->firstOrFail();

            $salary->update([
                'tgl_gajian' => $request->tgl_gajian,
                'total_gaji' => $request->total_gaji,
            ]);

            Alert::success('Berhasil', 'Data salary berhasil diperbarui');
            return back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = Auth::user();
            $salary = SalariesModel::where('id', $id)
                ->where('user_id', $user->id)
                ->firstOrFail();

            $salary->delete();

            Alert::success('Berhasil', 'Data salary berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
            return back();
        }
    }
}
