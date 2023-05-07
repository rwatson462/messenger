<?php

namespace Tests\Unit\Models;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class MessageTest extends TestCase
{
    public function test_correctlyCastsUuid(): void
    {
        $uuid = Uuid::uuid4();

        /** @var User $user */
        $user = User::factory()->create([
            'name' => 'Rob',
        ]);

        /** @var Conversation $conversation */
        $conversation = Conversation::factory()->create();

        /** @var Message $message */
        $message = Message::factory()->create([
            'uuid' => $uuid,
            'sender_uuid' => $user->uuid,
            'conversation_uuid' => $conversation->uuid,
        ]);

        $this->assertInstanceOf(UuidInterface::class, $message->uuid);
        $this->assertTrue($uuid->equals($message->uuid));
    }
}
