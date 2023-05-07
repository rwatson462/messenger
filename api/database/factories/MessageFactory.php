<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => Uuid::uuid4(),
            'body' => fake()->sentence(),
            'sender_uuid' => User::query()->inRandomOrder()->first()->uuid,
            'conversation_uuid' => Conversation::query()->inRandomOrder()->first()->uuid,
        ];
    }
}
