<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId("chat_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("sender_id")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("receiver_id")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText("message_text")->nullable();
            $table->string("type")->default("text");
            $table->double("lat")->nullable();
            $table->double("long")->nullable();
            $table->json("links")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
