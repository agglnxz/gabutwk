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
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("recipient_id");
            $table->unsignedBigInteger("postingan_id");
            $table->text("komentar");
            $table->unsignedBigInteger("parent_comment_id")->nullable();
            $table->timestamps();

            $table->foreign("sender_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("recipient_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("postingan_id")->references("id")->on("postingan")->onDelete("cascade");
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
