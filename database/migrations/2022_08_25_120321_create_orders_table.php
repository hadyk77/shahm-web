<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("captain_id")->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("offer_id")->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->double("product_price");
            $table->double("captain_cost");
            $table->double("tax")->default(0);
            $table->longText("order_items")->nullable();
            $table->string("payment_method");
            $table->string("payment_status");
            $table->string("order_status");
            $table->string("order_type");
            $table->string("drop_off_location")->nullable();
            $table->string("drop_off_location_lat")->nullable();
            $table->string("drop_off_location_long")->nullable();
            $table->string("pickup_location")->nullable();
            $table->string("pickup_location_lat")->nullable();
            $table->string("pickup_location_long")->nullable();
            $table->string("coupon_code")->nullable();
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
        Schema::dropIfExists('orders');
    }
};
