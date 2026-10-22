<?php

use App\Http\Controllers\AdvertismentController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PasswordForgottenController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SettingController;
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

    Route::resource('/advertisement', AdvertismentController::class)
     ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    
    Route::get('/advertisement/{advertisement}/promote', [AdvertismentController::class, 'promote'])->name('advertisement.promote');
    Route::post('/advertisement/{advertisement}/promote', [AdvertismentController::class, 'postPromote'])->name('advertisement.promote.post');
    Route::post('/advertisement/{advertisement}/contact', [AdvertismentController::class, 'contact'])->name('advertisement.contact');

    Route::get('/profile', [SettingController::class, 'profile'])->name('setting.profile');
    Route::patch('/profile/{user}', [SettingController::class, 'updateProfile'])->name('setting.update-profile');

    Route::get('/messageboxes', [MessageController::class, 'index'])->name('message.index');
    Route::get('/profile/{user}/message', [MessageController::class, 'create'])->name('message.create');
    Route::post('/profile/{user}/message', [MessageController::class, 'store'])->name('message.store');
    Route::get('/messagebox/{id}', [MessageController::class, 'show'])->name('messagebox.show');
    Route::post('/messagebox/{id}/message', [MessageController::class, 'newMessage'])->name('new.message');

    Route::resource('/categories', CategoryController::class)
     ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::post('/advertisement/{advertisement}/bidding', [BiddingController::class, 'store'])->name('advertisement.bidding');
});