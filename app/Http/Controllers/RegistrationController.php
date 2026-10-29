<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Mail\welcomeMail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;


use Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
        $validateData = $request->validated();

        $user = User::create($validateData);

        Mail::raw('Welkom bij marktplaats', function ($message) {
            $message->to('gast@test.nl')
                    ->subject('Welkom');
        });

        Mail::to($user->email)->send(new welcomeMail($user));

        return Redirect::route('login');
    }
}
