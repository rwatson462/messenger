<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('conversations.index', [
            'conversations' => Conversation::query()
                ->whereHasParticipant(auth()->user())
                ->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }
}
