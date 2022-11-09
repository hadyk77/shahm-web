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
        Schema::table('captains', function (Blueprint $table) {
            $table->foreignId("governorate_id")->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("nationality_id")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('captains', function (Blueprint $table) {
            $table->dropColumn("governorate_id");
            $table->dropColumn("nationality_id");
        });
    }
};
