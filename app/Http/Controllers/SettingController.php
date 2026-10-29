<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Auth;

class SettingController extends Controller
{
    public function profile(){
        $user = Auth::user();

        return view('settings.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, User $user){
        $validateData = $request->validated();

        $validateData['notification'] = $request->get('notification') == 'on' ? 1 : 0;

        $user->update($validateData);

        return Redirect::route('setting.profile')->with('success', 'Gegevens zijn aangepast');
    }
}
