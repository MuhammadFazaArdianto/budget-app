<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IncomeModel;
use App\Models\OutcomeModel;
use App\Models\SalariesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $salary = SalariesModel::where('user_id', $user->id)
                    ->whereDate('tgl_gajian', '<=', Carbon::now())
                    ->latest('tgl_gajian')
                    ->first();

        $totalGaji = $salary ? $salary->total_gaji : 0;

        $totalIncome = IncomeModel::where('user_id', $user->id)->sum('jumlah');
        $totalOutcome = OutcomeModel::where('user_id', $user->id)->sum('jumlah');

        $sisaUang = $totalGaji + $totalIncome - $totalOutcome;
        $recentIncomes = IncomeModel::where('user_id', $user->id)->latest()->take(5)->get();
        $recentOutcomes = OutcomeModel::where('user_id', $user->id)->latest()->take(5)->get();

        return view('user.dashboard.index', compact(
    'totalGaji',
    'sisaUang',
        'recentIncomes',
        'recentOutcomes',
        'totalIncome',
        'totalOutcome'
        ));
    }
}
