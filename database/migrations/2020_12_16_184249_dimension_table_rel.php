<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DimensionTableRel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dimension', function (Blueprint $table) {
            $table->unsignedInteger("userId");
            $table->foreign("userId")->references("id")->on("user");

            $table->unsignedInteger("questionId");
            $table->foreign("questionId")->references("id")->on("question");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dimension', function (Blueprint $table) {
            //
        });
    }
}
