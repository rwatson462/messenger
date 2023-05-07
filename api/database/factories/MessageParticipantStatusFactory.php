<?php

namespace Database\Factories;

use App\Constants\MessageStatus;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageParticipantStatus>
 */
class MessageParticipantStatusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'message_uuid' => Message::query()->inRandomOrder()->first()->uuid,
            'participant_uuid' => User::query()->inRandomOrder()->first()->uuid,
            'status' => MessageStatus::NEW,
        ];
    }
}
