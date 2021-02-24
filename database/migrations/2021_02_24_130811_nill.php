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
            $table->string("titreUser")->nullable()->change();
            $table->string("typeUser")->nullable()->change();
            $table->string("tailleUser")->nullable()->change();
            $table->string("secteurUser")->nullable()->change();
            $table->string("paysUser")->nullable()->change();
            $table->string("codeUser")->nullable()->change();
            $table->string("telephoneUser")->nullable()->change();
            $table->string("numeroUser")->nullable()->change();//
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
