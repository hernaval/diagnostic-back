<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string("titreUser")->nullable();
            $table->string("typeUser")->nullable();
            $table->string("tailleUser")->nullable();
            $table->string("secteurUser")->nullable();
            $table->string("paysUser")->nullable();
            $table->string("codeUser")->nullable();
            $table->string("telephoneUser")->nullable();
            $table->string("numeroUser")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
}
