<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

/**
 * @property string $title
 * @property Collection $recipients
 * @property Collection $messages
 * @property UuidInterface $uuid
 */
class Conversation extends Model
{
    use HasFactory;

    public $fillable = [
        'uuid',
        'title',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getUuidAttribute(): UuidInterface
    {
        return UuidV4::fromString($this->attributes['uuid']);
    }

    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'conversation_recipients',
            'conversation_uuid',
            'user_uuid',
            'uuid',
            'uuid'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation_uuid', 'uuid');
    }
}
