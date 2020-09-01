<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->increments('bookmark_id');

            //usersのidとarticlesのarticle_idと形式を一致させるため、unsigned（符号無し）属性を付与。これがないとエラーとなる。
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();

            $table->timestamps();

            //article_idに外部キー制約をつける。articlesテーブルのarticle_idカラムがなくなった場合カスケード的に削除する
            $table->foreign('article_id')
                ->references('article_id')
                ->on('articles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
