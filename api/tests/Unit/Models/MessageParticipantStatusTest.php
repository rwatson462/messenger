<?php

namespace Tests\Unit\Models;

use App\Models\MessageParticipantStatus;
use App\Models\User;
use Tests\TestCase;

class MessageParticipantStatusTest extends TestCase
{
    public function test_canGetParticipant(): void
    {
        $status = MessageParticipantStatus::factory()->create();

        $this->assertInstanceOf(User::class, $status->participant);
    }
}
