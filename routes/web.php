<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountAndRoleController;

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

