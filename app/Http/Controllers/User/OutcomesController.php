<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OutcomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OutcomesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = OutcomeModel::where('user_id', $user->id)->get();
        return view('user.outcomes.index',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tgl_pengeluaran' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $user = Auth::user();
            OutcomeModel::create([
                'user_id' => $user->id,
                'kategori' => $request->kategori,
                'jumlah' => $request->jumlah,
                'tgl_pengeluaran' => $request->tgl_pengeluaran,
                'keterangan' => $request->keterangan,
            ]);
    
            Alert::success('Berhasil', 'Data pengeluaran berhasil ditambahkan');
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
            'tgl_pengeluaran' => 'sometimes|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            $user = Auth::user();
            $income = OutcomeModel::where('user_id', $user->id)->findOrFail($id);

            $income->update($request->only([
                'kategori',
                'jumlah',
                'tgl_pengeluaran',
                'keterangan',
            ]));

            Alert::success('Berhasil', 'Data pengeluaran berhasil diperbarui');
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
            $income = OutcomeModel::where('user_id',$user->id)->findOrFail($id);
            $income->delete();

            alert()->success('Berhasil', 'Data pengeluaran berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            alert()->error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }
}
