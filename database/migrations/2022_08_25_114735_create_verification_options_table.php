<?php

use App\Enums\StatusEnum;
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
        Schema::create('verification_options', function (Blueprint $table) {
            $table->id();
            $table->json("title");
            $table->longText("description")->nullable();
            $table->boolean("status")->default(StatusEnum::ENABLED);
            $table->boolean("is_deletable")->default(StatusEnum::ENABLED);
            $table->string("related_orders");
            $table->string("purchase_link")->nullable();
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
        Schema::dropIfExists('verification_options');
    }
};
