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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("order_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("captain_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('offer_status');
            $table->double('price');

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
