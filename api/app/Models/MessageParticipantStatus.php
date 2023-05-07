<?php

namespace App\Models;

use App\Constants\MessageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageParticipantStatus extends Model
{
    use HasFactory;

    public $fillable = [
        'message_uuid',
        'participant_uuid',
        'status'
    ];

    public function message(): HasOne
    {
        return $this->hasOne(Message::class, 'uuid', 'message_uuid');
    }

    public function participant(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'participant_uuid');
    }
}
