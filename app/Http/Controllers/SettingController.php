<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

use Auth;

class SettingController extends Controller
{
    public function profile(){
        $user = Auth::user();

        return view('settings.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request){
        dd('hello');
    }
}
