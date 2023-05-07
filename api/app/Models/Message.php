<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $uuid
 * @property User $sender
 * @property Collection $participantStatuses
 * @property string $body
 */
class Message extends Model
{
    use HasFactory;

    protected $table = 'conversation_messages';

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

    public function participantStatuses(): HasMany
    {
        return $this->hasMany(MessageParticipantStatus::class, 'message_uuid', 'uuid');
    }
}
