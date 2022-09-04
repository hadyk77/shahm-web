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
        Schema::create('captain_verification_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId("captain_id")->constrained("captains")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("verification_option_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("user_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("status")->default(StatusEnum::DISABLED);
            $table->boolean("is_read")->default(StatusEnum::DISABLED);
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
        Schema::dropIfExists('captain_verification_files');
    }
};
