<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;

use App\Models\Message;
use App\Models\Inbox;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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

        return Redirect::route('message.show', $user);
    }

    public function show($user){

        $userId = last(explode('-', $user));

        $contact = User::findOrFail($userId);

        $currentUserId = Auth::id();
        
        $inbox = Inbox::where(function ($query) use ($currentUserId, $contact) {
            $query->where('seller_id', min($currentUserId, $contact->id))
                  ->where('customer_id', max($currentUserId, $contact->id));
        })->first();

        return view('message.show', compact('inbox', 'contact'));
    }

    public function newMessage(MessageRequest $request, $user, string $uuid)
    {   
        $message = Message::Create([
            'inbox_uuid'  => $uuid,
            'user_id'     => Auth::user()->id,
            'content'     => $request->content,
        ]);

        return Redirect::route('message.show', $user);
    }
}
