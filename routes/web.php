<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration.show');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function() {
    return view('dashboard');
});