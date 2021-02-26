<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usersasvearticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersToArticles', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("userId");
            $table->foreign("userId")->references("id")->on("user");

            $table->unsignedInteger("articleId");
            $table->foreign("articleId")->references("id")->on("articles");

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
        Schema::dropIfExists('userToArticle');
    }
}
