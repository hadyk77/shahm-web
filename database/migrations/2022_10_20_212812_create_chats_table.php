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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId("client_id")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("captain_id")->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("order_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("service_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean("is_captain_send_invoice")->default(false);
            $table->boolean("is_client_pay_invoice")->default(false);
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
        Schema::dropIfExists('chats');
    }
};
