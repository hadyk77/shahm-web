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
