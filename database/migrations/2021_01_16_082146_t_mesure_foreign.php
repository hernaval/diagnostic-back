<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TMesureForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TMesure', function (Blueprint $table) {
            $table->unsignedInteger("tDimensionId");
            $table->foreign("tDimensionId")->references("id")->on("TDimension");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TMesure', function (Blueprint $table) {
            //
        });
    }
}
