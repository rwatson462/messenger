<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->uuid();
            $table->string('title', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
