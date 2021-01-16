<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TRoreignRestitution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TRestitution', function (Blueprint $table) {
            $table->unsignedInteger("userId");
            $table->foreign("userId")->references("id")->on("user");

            $table->unsignedInteger("tMesureId");
            $table->foreign("tMesureId")->references("id")->on("TMesure");

            $table->unsignedInteger("tDimensionId");
            $table->foreign("tDimensionId")->references("id")->on("TDimension");

            $table->smallInteger("value")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TRestitution', function (Blueprint $table) {
            //
        });
    }
}
