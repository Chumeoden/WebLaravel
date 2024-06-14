<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountAndRoleController;
use App\Http\Controllers\HotelController;



// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home route
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes with auth and admin middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::put('/admin/user/{id}/role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::get('/admin/make-admin/{id}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
});

// routes/web.php
Route::get('/management/account_and_role', function () {
    return view('management.account_and_role');
})->name('management.account_and_role');

//
Route::resource('account_and_role', AccountAndRoleController::class);
Route::get('management/account_and_role', [AccountAndRoleController::class, 'index'])->name('account_and_role.index');
Route::delete('management/account_and_role/{user}', [AccountAndRoleController::class, 'destroy'])->name('account_and_role.destroy');
Route::get('management/account_and_role/{user}/edit', [AccountAndRoleController::class, 'edit'])->name('account_and_role.edit');
Route::put('management/account_and_role/{user}', [AccountAndRoleController::class, 'update'])->name('account_and_role.update');

// Route để hiển thị danh sách khách sạn
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');

// Route để hiển thị form tạo mới khách sạn
Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotel.create');

// Route để lưu thông tin khách sạn mới tạo
Route::post('/hotels', [HotelController::class, 'store'])->name('hotel.store');

// Hotel routes
Route::prefix('hotels')->group(function () {
    Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('/store', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('/{id}', [HotelController::class, 'show'])->name('hotels.show');
    Route::get('/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::put('/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');
});
