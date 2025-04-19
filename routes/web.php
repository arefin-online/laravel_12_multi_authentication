<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');

// User
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('profile_submit');
});
Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/registration', [UserController::class, 'registration_submit'])->name('registration_submit');
Route::get('/registration-verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('registration_verify');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_submit'])->name('login_submit');
Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');



// Admin
Route::middleware('admin')->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');
});

Route::prefix('admin')->group(function(){
    Route::get('/', function () {return redirect()->route('admin_login');});
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});
