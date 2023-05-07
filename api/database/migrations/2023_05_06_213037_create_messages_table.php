<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversation_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->uuid();
            $table->string('body');
            $table->uuid('sender_uuid');
            $table->uuid('conversation_uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
