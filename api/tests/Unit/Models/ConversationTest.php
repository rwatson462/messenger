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

    public function test_canGetParticipants(): void
    {
        /** @var Conversation $conversation */
        $conversation = Conversation::factory()
            ->has(User::factory(3), 'participants')
            ->create();

        // Even though we added 3 participants above, the creator is also added as a participant
        $this->assertCount(4, $conversation->participants);
    }

    public function test_canGetMessages(): void
    {
        /** @var Conversation $conversation */
        $conversation = Conversation::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();

        $conversation->participants()->attach($user);

        $message = Message::factory()->create([
            'sender_uuid' => $user->uuid,
            'conversation_uuid' => $conversation->uuid,
        ]);

        $this->assertCount(1, $conversation->messages);
    }

    public function test_canGetCreator(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Conversation $conversation */
        $conversation = Conversation::factory()->create([
            'created_by_uuid' => $user->uuid,
        ]);

        $this->assertEquals($user->uuid, $conversation->creator->uuid);
    }
}
