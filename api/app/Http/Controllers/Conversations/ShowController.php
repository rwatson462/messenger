<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Conversation $conversation)
    {
        return view('conversation.show', [
            'conversation' => $conversation
        ]);
    }
}
