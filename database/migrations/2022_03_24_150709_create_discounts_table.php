<?php

use App\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('type');
            $table->string('percentage')->nullable();
            $table->string('amount')->nullable();
            $table->string('quantity');
            $table->integer('quantity_number')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->boolean("status")->default(StatusEnum::DISABLED);
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
        Schema::dropIfExists('discounts');
    }
}
