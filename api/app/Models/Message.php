<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $uuid
 * @property User $sender
 * @property string $body
 */
class Message extends Model
{
    use HasFactory;

    public $fillable = [
        'uuid',
        'body',
        'sender_uuid',
        'conversation_uuid',
    ];

    public function getUuidAttribute(): UuidInterface
    {
        return UuidV4::fromString($this->attributes['uuid']);
    }

    public function sender(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'sender_uuid');
    }
}
