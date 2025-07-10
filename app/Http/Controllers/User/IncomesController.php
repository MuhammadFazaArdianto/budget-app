<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IncomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class IncomesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = IncomeModel::where('user_id', $user->id)->get();
        return view('user.incomes.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tgl_pemasukan' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $user = Auth::user();
            IncomeModel::create([
                'user_id' => $user->id,
                'kategori' => $request->kategori,
                'jumlah' => $request->jumlah,
                'tgl_pemasukan' => $request->tgl_pemasukan,
                'keterangan' => $request->keterangan,
            ]);
    
            Alert::success('Berhasil', 'Data pemasukan berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'sometimes|string|max:255',
            'jumlah' => 'sometimes|numeric|min:0',
            'tgl_pemasukan' => 'sometimes|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $user = Auth::user();
            $income = IncomeModel::where('user_id', $user->id)->findOrFail($id);

            $income->update($request->only([
                'kategori',
                'jumlah',
                'tgl_pemasukan',
                'keterangan',
            ]));

            Alert::success('Berhasil', 'Data pemasukan berhasil diperbarui');
            return back();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = Auth::user();
            $income = IncomeModel::where('user_id',$user->id)->findOrFail($id);
            $income->delete();

            alert()->success('Berhasil', 'Data pemasukan berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }
}
