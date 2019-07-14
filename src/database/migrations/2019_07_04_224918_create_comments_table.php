<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment("コメントID");
            $table->unsignedInteger('parent_article_id')->comment("親記事ID");
            $table->string('contributor')->comment("投稿者");
            $table->text('text')->comment("本文");
            $table->boolean('approval_flg')->comment("承認フラグ");
            $table->unsignedInteger('approval_user_id')->nullable()->comment("承認ユーザID");
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
        Schema::dropIfExists('comments');
    }
}
