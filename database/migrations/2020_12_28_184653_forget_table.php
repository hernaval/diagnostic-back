<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forgot', function (Blueprint $table) {
            $table->increments('id');
            $table->string("token")->unique();
            $table->boolean("isValid")->default(true);
            $table->timestamps();

            $table->unsignedInteger("userId");
            $table->foreign("userId")->references("id")->on("user");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forgot');
    }
}
