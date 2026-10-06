<?php

use App\Http\Controllers\AdvertismentController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordForgottenController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration.show');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [PasswordForgottenController::class, 'show'])->middleware('guest')->name('forgotPassword.show');
Route::post('/forgot-password', [PasswordForgottenController::class, 'post'])->middleware('guest')->name('forgotPassword.post');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'show'])->middleware('guest')->name('password.reset');
Route::post('/reset-password/{token}', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.reset');

Route::middleware(['auth'])->group( function() {
    Route::get('/dashboard', [AdvertismentController::class, 'index'])->name('advertisement.dashboard');

    Route::resource('/advertisement', AdvertismentController::class);
    Route::resource('/categories', CategoryController::class);

    Route::post('/advertisement/{advertisement}/bidding', [BiddingController::class, 'store'])->name('advertisement.bidding');
});