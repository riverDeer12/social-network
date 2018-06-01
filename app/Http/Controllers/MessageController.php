<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function messages()
    {
        return view('messages');
    }

    public function conversation($contact_id)
    {
        $messages = Message::where(function($q) use ($contact_id) {
            $q->where('from', Auth::user()->id);
            $q->where('to', $contact_id);
        })->orWhere(function($q) use ($contact_id) {
            $q->where('from', $contact_id);
            $q->where('to', Auth::user()->id);
        })->get();

        return response()->json($messages);
    }

    public function send_message(Request $request)
    {
        $message = Message::create([
            'from' => Auth::user()->id,
            'to' => $request->contact_id,
            'message' => $request->message,
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
