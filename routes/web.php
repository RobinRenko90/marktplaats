<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration.show');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');