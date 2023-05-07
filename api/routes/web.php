<?php

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;

Route::get('/login', function() {
    return 'Login page';
})->name('login');

Route::prefix('/')->middleware('auth.session')->group(function() {

    Route::get('/', function() {
        return view('conversations.index', [
            'conversations' => Conversation::all(),
            'users' => User::all(),
        ]);
    })->name('conversations.index');

    Route::prefix('/new')->group(function() {

        Route::get('/', function() {
            return view('conversation.new');
        })->name('conversation.new');

        Route::post('/', function(Request $request) {
            $input = $request->validate([
                'title' => 'required|max:255',
            ]);

            $conversation = Conversation::create([
                'uuid' => Uuid::uuid4(),
                'title' => $input['title'],
            ]);

            return redirect(route('conversation.show', [
                'conversation' => $conversation->uuid,
            ]));
        });
    });

    Route::prefix('/conversation')->group(function() {

        Route::prefix('/{conversation}')->group(function() {

            Route::get('/', function (Conversation $conversation) {
                return view('conversation.show', [
                    'conversation' => $conversation
                ]);
            })->name('conversation.show');

            Route::post('/', function(Conversation $conversation, Request $request) {
                $message = $request->validate([
                    'message' => 'required|max:255',
                ]);

                // todo find sender uuid from auth user
                Message::create([
                    'body' => $message['message'],
                    'sender_uuid' => $conversation->recipients()->inRandomOrder()->first()->uuid,
                    'conversation_uuid' => $conversation->uuid,
                    'uuid' => Uuid::uuid4(),
                ]);

                return redirect(route('conversation.show', ['conversation' => $conversation->uuid]));

            })->name('conversation.message.send');
        });

    });

});
