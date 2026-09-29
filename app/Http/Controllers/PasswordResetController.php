<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function show(string $token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function update(PasswordResetRequest $request, string $token)
    {
        $request->validated($request);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );

         return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', $status)
            : back()->withErrors(['email' => [$status]]);
    }
}
