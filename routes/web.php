<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\IncomesController;
use App\Http\Controllers\User\OutcomesController;
use App\Http\Controllers\User\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.welcome-pages');
});


Route::get('/auth/login',[AuthController::class, 'login'])->name('login');
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'loginFunction'])->name('login.function');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'registerFunction'])->name('register.function');

Route::middleware('role:user')->group(function () {
    Route::get('/dashboard-user',[DashboardController::class, 'index'])->name('user.dashboard');
    
    // salaries
    Route::get('/dashboard-salary',[SalaryController::class, 'index'])->name('user.salary');
    Route::post('/dashboard-salary/store', [SalaryController::class, 'store'])->name('user.salary.store');
    Route::patch('/dashboard-salary/update/{id}', [SalaryController::class, 'update'])->name('user.salary.update');
    Route::delete('/dashboard-salary/delete/{id}', [SalaryController::class, 'destroy'])->name('user.salary.delete');

    // incomes
    Route::get('/dashboard-incomes',[IncomesController::class, 'index'])->name('user.incomes');
    Route::post('/dashboard-incomes/store', [IncomesController::class, 'store'])->name('user.incomes.store');
    Route::patch('/dashboard-incomes/update/{id}', [IncomesController::class, 'update'])->name('user.incomes.update');
    Route::delete('/dashboard-incomes/delete/{id}', [IncomesController::class, 'destroy'])->name('user.incomes.delete');

    // outcomes
    Route::get('/dashboard-outcomes',[OutcomesController::class, 'index'])->name('user.outcomes');
    Route::post('/dashboard-outcomes/store', [OutcomesController::class, 'store'])->name('user.outcomes.store');
    Route::patch('/dashboard-outcomes/update/{id}', [OutcomesController::class, 'update'])->name('user.outcomes.update');
    Route::delete('/dashboard-outcomes/delete/{id}', [OutcomesController::class, 'destroy'])->name('user.outcomes.delete');
});

Route::middleware('role:admin')->group(function () {
    Route::get('/dashboard-admin',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard-admin/user',[AdminDashboardController::class, 'user'])->name('admin.user');
    Route::post('/dashboard-admin/user/store', [AdminDashboardController::class, 'store'])->name('admin.user.store');
    Route::patch('/dashboard-admin/user/update/{id}', [AdminDashboardController::class, 'update'])->name('admin.user.update');
    Route::delete('/dashboard-admin/user/delete/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.user.delete');
});