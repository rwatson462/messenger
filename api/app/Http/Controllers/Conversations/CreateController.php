<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $input = $request->validate([
            'to' => 'required|uuid|exists:users,uuid',
        ]);

        return view('conversation.new', [
            'to' => User::firstWhere('uuid', $input['to']),
        ]);
    }
}
