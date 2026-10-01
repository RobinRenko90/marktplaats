<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

        Auth::login($user);

        return redirect('dashboard');
    }
}
