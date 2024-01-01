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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('recipient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('postingan_id')->references('id')->on('postingan')->onDelete('cascade')->nullable();
            $table->enum('status', ['postingan', 'komentar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
