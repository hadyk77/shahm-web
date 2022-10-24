<?php

use App\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cancel_reasons', function (Blueprint $table) {
            $table->id();
            $table->json("title");
            $table->boolean("status")->default(StatusEnum::ENABLED);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cancel_reasons');
    }
};
