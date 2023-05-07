<?php

namespace App\Http\Controllers\Conversations;

use App\Events\Conversation\MessageSentEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageParticipantStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $input = $request->validate([
            'to' => 'required|uuid|exists:users,uuid',
            'message' => 'required|max:255',
        ]);

        $recipient = User::firstWhere('uuid', $input['to']);

        if(!$recipient) {
            return response('No user found', Response::HTTP_NOT_FOUND);
        }

        $subject = "Message to {$recipient->name}";

        $conversation = Conversation::create([
            'uuid' => Uuid::uuid4(),
            'title' => $subject,
            'created_by_uuid' => auth()->user()->uuid,
        ]);

        // attach the logged-in user as a participant in the conversation
        $conversation->participants()->attach(auth()->user());
        $conversation->participants()->attach($recipient);

        $message = Message::create([
            'uuid' => Uuid::uuid4(),
            'body' => $input['message'],
            'sender_uuid' => auth()->user()->uuid,
            'conversation_uuid' => $conversation->uuid,
        ]);

        $status = MessageParticipantStatus::create([
            'message_uuid' => $message->uuid,
            'participant_uuid' => $recipient->uuid,
        ]);

        // todo send Firebase Cloud notification of message sent
        MessageSentEvent::dispatch($message);

        return redirect(route('conversation.show', [
            'conversation' => $conversation->uuid,
        ]));
    }
}
