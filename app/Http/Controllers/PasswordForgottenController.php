<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordForgottenRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class PasswordForgottenController extends Controller
{
    public function show() {
        return view('auth.forgot-password');
    }

    public function post(PasswordForgottenRequest $request) {
        
        $request->validated($request);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['success' => 'Een wachtwoordwijziging is aangevraagd, controleer jouw mail.'])
            : back()->withErrors(['email' => $status]);
    }
}
