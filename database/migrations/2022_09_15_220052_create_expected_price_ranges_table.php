<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('expected_price_ranges', function (Blueprint $table) {
            $table->id();
            $table->double("kilometer_from");
            $table->double("kilometer_to");
            $table->double("price_from");
            $table->double("price_to");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expected_price_ranges');
    }
};
