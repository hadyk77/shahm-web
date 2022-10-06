<?php

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
        Schema::create('captains', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("vehicle_type_id")->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("vehicle_manufacturing_date")->nullable();
            $table->string("vehicle_number")->nullable();
            $table->string("vehicle_identification_number")->nullable();
            $table->string("vehicle_license_plate_number")->nullable();
            $table->double("exceed_indebtedness")->default(0);
            $table->foreignId("nationality_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("identification_number");
            $table->string("wallet_number")->nullable();
            $table->boolean("enable_order")->default(StatusEnum::ENABLED);

            // between_governorate_service
            $table->boolean("enable_between_governorate_service")->default(StatusEnum::DISABLED);
            $table->foreignId("pickup_id")->nullable()->constrained("governorates")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("drop_off_id")->nullable()->constrained("governorates")->cascadeOnUpdate()->cascadeOnDelete();
            $table->time("between_governorate_time")->nullable();
            $table->date("between_governorate_date")->nullable();


            $table->foreignId("account_upgrade_option_id")->nullable()->constrained("account_upgrade_options")->nullOnDelete();

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
        Schema::dropIfExists('captains');
    }
};
