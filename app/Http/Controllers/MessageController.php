<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;

use App\Models\Message;
use App\Models\Inbox;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;

class MessageController extends Controller
{
    public function index(){
        $inboxes = Inbox::where('seller_id', Auth::user()->id)->orWhere('customer_id', Auth::user()->id)->get();

        return view('message.index', compact('inboxes'));
    }

    public function store(MessageRequest $request, $user){

        $userId = last(explode('-', $user));

        $advertiser = User::findOrFail($userId);

        $inbox = Inbox::firstOrCreate([
            'seller_id'     => $advertiser->id,
            'customer_id'   => Auth::user()->id,
        ]);

        Message::Create([
            'inbox_uuid'    => $inbox->uuid,
            'user_id'       => Auth::user()->id,
            'content'       => $request->content,
        ]);

        return route('message.show', $user);

    }

    public function show($user){

        $userId = last(explode('-', $user));

        $advertiser = User::findOrFail($userId);

        $currentUserId = Auth::id();

        $inbox = Inbox::where(function ($query) use ($currentUserId, $advertiser) {
            $query->where('seller_id', min($currentUserId, $advertiser->id))
                  ->where('customer_id', max($currentUserId, $advertiser->id));
        })->first();

        return view('message.show', compact('inbox', 'advertiser'));
    }

    public function newMessage(MessageRequest $request, User $user, string $uuid)
    {   
        dd('hello');

        $message = Message::Create([
            'inbox_uuid'  => $uuid,
            'user_id'     => Auth::user()->id,
            'content'     => $request->content,
        ]);

        return route('message.show', $user->slug);

    }
}
