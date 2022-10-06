<?php

use App\Enums\OfferEnum;
use App\Enums\StatusEnum;
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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("order_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("captain_id")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();

            $table->double("captain_lat")->nullable();
            $table->double("captain_long")->nullable();
            $table->double("distance")->nullable();

            $table->string('offer_status')->default(OfferEnum::PENDING);
            $table->double('price');

            $table->double("app_profit_from_captain")->default(0);
            $table->double("app_profit_from_user")->default(0);
            $table->double("offer_total_cost");

            $table->boolean("is_between_governorate_service")->default(StatusEnum::DISABLED);
            $table->foreignId("governorate_from_id")->nullable()->constrained("governorates")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("governorate_to_id")->nullable()->constrained("governorates")->cascadeOnUpdate()->cascadeOnDelete();
            $table->date("between_governorate_date")->nullable();

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
        Schema::dropIfExists('offers');
    }
};
