<?php

use App\Enums\OrderEnum;
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
        Schema::disableForeignKeyConstraints();
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("between_governorate_service_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("captain_id")->nullable()->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("offer_id")->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('expected_price_range_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->double("items_price")->nullable();

            $table->double("app_profit_from_captain")->nullable();
            $table->double("app_profit_from_user")->nullable();
            $table->double("captain_profit")->nullable();
            $table->double("delivery_cost_with_user_commission")->nullable();
            $table->double("delivery_cost_without_user_commission")->nullable();
            $table->double("tax")->default(0);
            $table->double("tax_percentage")->default(0);
            $table->double("grand_total")->nullable();
            $table->longText("order_items")->nullable();
            $table->string("payment_method");


            $table->string("order_code")->nullable();
            $table->string("payment_status")->default(OrderEnum::UNPAID);
            $table->string("order_status")->default(OrderEnum::WAITING_OFFERS);
            $table->string("order_type");

            $table->string("drop_off_location")->nullable();
            $table->string("drop_off_description")->nullable();
            $table->double("drop_off_location_lat")->nullable();
            $table->double("drop_off_location_long")->nullable();

            $table->string("pickup_location")->nullable();
            $table->string("pickup_description")->nullable();
            $table->double("pickup_location_lat")->nullable();
            $table->double("pickup_location_long")->nullable();

            $table->double("distance")->nullable();
            $table->string("discount_code")->nullable();
            $table->string("discount_amount")->nullable();


            $table->string("cancel_reason")->nullable();

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
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
