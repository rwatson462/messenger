<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|max:255',
        ]);

        if (auth()->attempt($credentials)) {
            // log in successful!
            return redirect(route('conversations.index'));
        }

        return redirect('/login')->withErrors([
            'email' => 'Invalid username/password combination',
        ]);
    }
}
