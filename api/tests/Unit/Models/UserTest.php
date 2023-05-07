<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Ramsey\Uuid\UuidInterface;

class UserTest extends TestCase
{
    public function test_correctlyCastsUuid(): void
    {
        $uuid = Uuid::uuid4();

        /** @var User $user */
        $user = User::factory()->create([
            'name' => 'Rob',
            'uuid' => $uuid,
        ]);

        $this->assertEquals('Rob', $user->name);
        $this->assertInstanceOf(UuidInterface::class, $user->uuid);
        $this->assertTrue($uuid->equals($user->uuid));
    }
}
