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

         Conversation::factory(10)
             ->has(User::factory(3), 'recipients')
             ->create();

         Conversation::all()->map(function(Conversation $conversation) {
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
