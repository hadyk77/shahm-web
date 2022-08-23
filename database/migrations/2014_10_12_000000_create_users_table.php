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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string("gender");
            $table->boolean('status')->default(StatusEnum::ENABLED);
            $table->point("location")->nullable();
            $table->string("address")->nullable();
            $table->boolean("is_captain")->default(StatusEnum::DISABLED);
            $table->string("app_version")->default("1.0.0");
            $table->string("default_lang")->default("ar");
            $table->boolean("enable_notification")->default(StatusEnum::ENABLED);
            $table->string("social_login_type")->nullable();
            $table->unsignedBigInteger("social_login_id")->nullable();
            $table->timestamp("phone_verified_at")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('device_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
