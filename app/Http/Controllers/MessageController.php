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

    public function create(){
        return view ('message.create');
    }

    public function store(Request $request,User $user){
        $messageBox = MessageBox::create([
            'seller_id'     => $user->id,
            'interested_id' => Auth::user()->id,
        ]);
    }

    public function show($id){
        $messageBox = Messagebox::where('id', $id)
            ->with('messages')
            ->first();

        return view ('message.show', compact('messageBox'));
    }

    public function newMessage(MessageRequest $request, $id)
    {   
        $message = Message::Create([
            'message_box_id'    => $id,
            'user_id'           => Auth::user()->id,
            'content'           => $request->content,
        ]);
        
        return redirect()->back();
    }
}
