<?php

namespace App\Http\Middleware;

use App\Models\SalariesModel;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            Alert::error('Access Denied', 'Kamu tidak punya akses untuk mengakses halaman ini.');
            return redirect()->back();
        }

        $salary = SalariesModel::where('user_id', auth()->id())->latest('tgl_gajian')->first();

        if ($salary) {
            $nextGajian = Carbon::parse($salary->tgl_gajian)->addMonth()->translatedFormat('d F Y');

            session()->flash('next_salary_reminder', "Gaji berikutnya akan cair sekitar tanggal <strong>$nextGajian</strong>");
        }

        return $next($request);
    }
}
