<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\FAQsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SuggestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard.dashboard');
// });

Auth::routes();

Route::get('', [LoginController::class, 'adminLoginForm'])->name('Home');
Route::get('/admin', [LoginController::class, 'adminLoginForm'])->name('AdminLogin');
Route::post('/admin-login', [LoginController::class, 'adminlogin'])->name('AdminLoginReq');
Route::get('/admin-logout', [LoginController::class, 'adminLogout'])->name('AdminLogout');
Route::prefix('admin')->group(function () {
    Route::get('/list', [AdminController::class, 'index'])->name('AdminList');
    Route::get('/add', [AdminController::class, 'create'])->name('AdminAdd');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('AdminEdit');
    Route::post('/create', [AdminController::class, 'store'])->name('AdminCreate');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('AdminUpdate');
    Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('AdminDelete');
    Route::get('/profile', [AdminController::class, 'Profile'])->name('AdminProfile');
    Route::put('profile/update', [AdminController::class, 'profileUpdate'])->name('AdminProfileUpdate');
});
Route::prefix('dashboard')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('Dashboard');
    Route::prefix('users')->group(function () {
        Route::get('list', [UserController::class, 'index'])->name('UserList');
        Route::get('add', [UserController::class, 'create'])->name('UserAdd');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('UserEdit');
        Route::post('create', [UserController::class, 'store'])->name('UserCreate');
        Route::put('update/{id}', [UserController::class, 'update'])->name('UserUpdate');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('UserDelete');
    });
    Route::prefix('suggestion')->group(function () {
        Route::get('list', [SuggestionController::class, 'index'])->name('SuggestionList');
        Route::get('edit/{id}', [SuggestionController::class, 'edit'])->name('SuggestionEdit');
        Route::post('create', [SuggestionController::class, 'create'])->name('SuggestionCreate');
        Route::put('update/{id}', [SuggestionController::class, 'update'])->name('SuggestionUpdate');
        Route::get('delete/{id}', [SuggestionController::class, 'destory'])->name('SuggestionDelete');
    });
    Route::prefix('report')->group(function () {
        Route::get('list', [ReportController::class, 'index'])->name('ReportList');
        Route::get('edit/{id}', [ReportController::class, 'edit'])->name('ReportEdit');
        Route::post('create', [ReportController::class, 'create'])->name('ReportCreate');
        Route::put('update/{id}', [ReportController::class, 'update'])->name('ReportUpdate');
        Route::get('delete/{id}', [ReportController::class, 'destory'])->name('ReportDelete');
    });
});
Route::get('app-optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return redirect()->route('Dashboard');
});

Route::get('migrate-database', function () {
    Artisan::call('migrate:fresh --seed');
    return redirect()->route('Dashboard');
});
