<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Conversations\CreateController;
use App\Http\Controllers\Conversations\IndexController;
use App\Http\Controllers\Conversations\ShowController;
use App\Http\Controllers\Conversations\StoreController;
use App\Http\Controllers\Message\SendController;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;

Route::prefix('/login')->group(function() {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', LoginController::class);
});

Route::get('/logout', LogoutController::class)->name('logout');

Route::prefix('/')->middleware('auth')->group(function() {
    Route::get('/', IndexController::class)->name('conversations.index');

    Route::prefix('/conversation')->group(function() {
        Route::get('/new/', CreateController::class)->name('conversation.new');
        Route::post('/new', StoreController::class)->name('conversation.store');

        Route::post('/', StoreController::class)->name('conversation.create');

        Route::prefix('/{conversation}')->group(function() {

            Route::get('/', ShowController::class)->name('conversation.show');

            Route::post('/', SendController::class)->name('conversation.message.send');
        });

    });

});
