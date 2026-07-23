<?php

use App\Http\Controllers\Admin\AdmUserController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\User\TicketController as UserTicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserController as ControllersUserController;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('auth.login');
});

// Rute untuk admin dengan middleware 'auth' dan 'role:admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('admtickets', AdminTicketController::class);
    Route::resource('users', AdmUserController::class);
});



// Rute untuk user dengan middleware 'auth' dan 'role:user'
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::resource('usrtickets', UserTicketController::class);
});



// Rute dashboard dengan middleware 'auth', 'verified', dan 'role:admin'
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Kelompok rute yang memerlukan otentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk autentikasi
require __DIR__ . '/auth.php';
