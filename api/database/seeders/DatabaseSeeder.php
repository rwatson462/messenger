<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         User::factory(10)->create();

         Conversation::factory(10)->create();

         Conversation::all()->map(function(Conversation $conversation) {
             // Add 3 recipients
             $conversation->recipients()->attach(User::query()->inRandomOrder()->take(3)->get());

             // Add 10 messages
             $i=10;
             while ($i--) {
                 Message::factory()->create([
                     'sender_uuid' => $conversation->recipients()->inRandomOrder()->first()->uuid,
                     'conversation_uuid' => $conversation->uuid,
                 ]);
             }
         });

    }
}
