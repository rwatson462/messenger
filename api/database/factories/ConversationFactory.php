<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => Uuid::uuid4(),
            'title' => fake()->word(),
            'created_by_uuid' => User::factory()->create()->uuid,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Conversation $conversation) {
            $conversation->participants()->attach($conversation->creator);
        });
    }
}
