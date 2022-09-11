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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("captain_id")->nullable()->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("order_id")->nullable()->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("done_by")->nullable()->constrained("admins")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("transaction_type");
            $table->string("transaction_code");
            $table->double("price_amount");
            $table->boolean("is_added_price")->default(StatusEnum::ENABLED);
            $table->longText("title");
            $table->string("notes")->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
