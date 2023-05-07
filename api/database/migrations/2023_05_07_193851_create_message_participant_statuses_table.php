<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message_participant_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->uuid('message_uuid');
            $table->uuid('participant_uuid');
            $table->string('status')->default(\App\Constants\MessageStatus::NEW);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_participant_statuses');
    }
};
