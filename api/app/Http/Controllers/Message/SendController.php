<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'conversationId' => 'required|uuid|exists:conversations,uuid',
            'message' => 'required|max:255',
        ]);

        return [
            'conversationId' => $request->input('conversationId'),
            'message' => $request->input('message'),
        ];
    }
}
