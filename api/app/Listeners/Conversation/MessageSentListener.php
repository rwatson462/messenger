<?php

namespace App\Listeners\Conversation;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageSentListener
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        info($event->message);
    }
}
