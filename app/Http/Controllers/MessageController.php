<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;

use App\Models\Message;
use App\Models\MessageBox;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;

class MessageController extends Controller
{
    public function index(){
        $messageboxes = MessageBox::where('seller_id', Auth::user()->id)->orWhere('interested_id', Auth::user()->id)->get();

        return view('message.index', compact('messageboxes'));
    }

    public function store(MessageRequest $request,User $user){

        $messageBox = MessageBox::create([
            'seller_id'     => $user->id,
            'interested_id' => Auth::user()->id,
        ]);

        $message = Message::Create([
            'message_box_uuid'    => $messageBox->uuid,
            'user_id'           => Auth::user()->id,
            'content'           => $request->content,
        ]);

        return view ('message.show', compact('messageBox', 'advertiser'));

    }

    public function show($user){

        $userId = last(explode('-', $user));

        $advertiser = User::findOrFail($userId);

        $currentUserId = Auth::id();

        $messageBox = MessageBox::where(function ($query) use ($currentUserId, $advertiser) {
            $query->where('seller_id', min($currentUserId, $advertiser->id))
                  ->where('interested_id', max($currentUserId, $advertiser->id));
        })->first();

        return view ('message.show', compact('messageBox', 'advertiser'));
    }

    public function newMessage(MessageRequest $request, $uuid)
    {   
        $message = Message::Create([
            'message_box_uuid'  => $uuid,
            'user_id'           => Auth::user()->id,
            'content'           => $request->content,
        ]);
        
        return redirect()->back();
    }
}
