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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("sender_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignUuid("recipient_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignUuid("postingan_id")->references("id")->on("postingan")->onDelete("cascade");
            $table->text("komentar");
            $table->unsignedBigInteger("parent_comment_id")->nullable();
            $table->timestamps();
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
