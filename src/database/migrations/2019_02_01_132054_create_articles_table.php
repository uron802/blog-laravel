<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment("タイトル");
            $table->text('text')->comment("本文");
            $table->boolean('is_draft')->comment("下書きフラグ");
            $table->dateTime('post_date_time')->nullable()->comment("投稿日時");
            $table->unsignedInteger('author')->comment("作成者");
            $table->unsignedInteger('changer')->comment("更新者");
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
        Schema::dropIfExists('articles');
    }
}
