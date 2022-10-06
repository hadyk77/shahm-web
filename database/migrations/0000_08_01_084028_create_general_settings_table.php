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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->json("title");
            $table->json("description");

            $table->string("first_email")->nullable();
            $table->string("second_email")->nullable();
            $table->string("first_phone")->nullable();
            $table->string("second_phone")->nullable();

            $table->string("facebook_link")->nullable();
            $table->string("twitter_link")->nullable();
            $table->string("instagram_link")->nullable();
            $table->string("linkedin_link")->nullable();
            $table->string("snapchat_link")->nullable();
            $table->string("tiktok_link")->nullable();

            $table->string("fcm_key")->nullable();
            $table->string("firebase_api_key")->nullable();
            $table->string("firebase_auth_domain")->nullable();
            $table->string("firebase_database_url")->nullable();
            $table->string("firebase_project_id")->nullable();
            $table->string("firebase_storage_bucket")->nullable();
            $table->string("firebase_messaging_sender_id")->nullable();
            $table->string("firebase_app_id")->nullable();

            $table->boolean("is_credit_card_enabled")->default(StatusEnum::ENABLED);
            $table->boolean("is_wallet_enabled")->default(StatusEnum::ENABLED);
            $table->boolean("is_cash_enabled")->default(StatusEnum::ENABLED);

            $table->double("client_commission")->default(0);
            $table->double("captain_commission")->default(0);
            $table->double("tax")->default(15);
            $table->double("maximum_indebtedness_for_captain")->default(100);
            $table->double("service_price_per_kilometer")->default(10);

            $table->string("app_version")->default('1.0.0');

            $table->double("max_radius")->default(5);

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
        Schema::dropIfExists('general_settings');
    }
};
