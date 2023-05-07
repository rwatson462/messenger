<?php

namespace Tests\Unit\Models;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ConversationTest extends TestCase
{
    public function test_correctlyCastsUuid(): void
    {
        $uuid = Uuid::uuid4();
        $title = 'test';

        /** @var Conversation $conversation */
        $conversation = Conversation::factory()->create([
            'title' => $title,
            'uuid' => $uuid,
        ]);

        $this->assertEquals($title, $conversation->title);
        $this->assertInstanceOf(UuidInterface::class, $conversation->uuid);
        $this->assertTrue($uuid->equals($conversation->uuid));
    }

    public function test_canGetRecipients(): void
    {
        /** @var Conversation $conversation */
        $conversation = Conversation::factory()
            ->has(User::factory(3), 'recipients')
            ->create();

        $this->assertCount(3, $conversation->recipients);
    }

    public function test_canGetMessages(): void
    {
        /** @var Conversation $conversation */
        $conversation = Conversation::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $conversation->recipients()->attach($user);

        $message = Message::factory()->create([
            'sender_uuid' => $user->uuid,
            'conversation_uuid' => $conversation->uuid,
        ]);

        $this->assertCount(1, $conversation->messages);
    }
}
