<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TDimensionForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TDimension', function (Blueprint $table) {
            $table->unsignedInteger("tQuestionnaireId");
            $table->foreign("tQuestionnaireId")->references("id")->on("TQuestionnaire");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TDimension', function (Blueprint $table) {
            //
        });
    }
}
