<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

/**
 * @property string $title
 * @property Collection $participants
 * @property Collection $messages
 * @property User $creator
 * @property UuidInterface $uuid
 */
class Conversation extends Model
{
    use HasFactory;

    public $fillable = [
        'uuid',
        'title',
        'created_by_uuid',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getUuidAttribute(): UuidInterface
    {
        return UuidV4::fromString($this->attributes['uuid']);
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'created_by_uuid');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'conversation_participants',
            'conversation_uuid',
            'user_uuid',
            'uuid',
            'uuid'
        );
    }

    public function scopeWhereHasParticipant(Builder $query, User $participant): Builder
    {
        return $query->whereHas('participants', fn($query) => $query->where('uuid', $participant->uuid));
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation_uuid', 'uuid');
    }
}
