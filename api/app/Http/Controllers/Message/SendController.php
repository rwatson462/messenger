<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SendController extends Controller
{
    public function __invoke(Request $request, Conversation $conversation)
    {
        $message = $request->validate([
            'message' => 'required|max:255',
        ]);

        Message::create([
            'body' => $message['message'],
            'sender_uuid' => auth()->user()->uuid,
            'conversation_uuid' => $conversation->uuid,
            'uuid' => Uuid::uuid4(),
        ]);

        return redirect(route('conversation.show', ['conversation' => $conversation->uuid]));
    }
}
