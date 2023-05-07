<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversation_participants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('conversation_uuid');
            $table->uuid('user_uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversation_participants');
    }
};
