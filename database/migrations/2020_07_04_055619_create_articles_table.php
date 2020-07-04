<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->increments('article_id');
            $table->integer('user_id');
            $table->string('title');

            //タグは最低１つあればいいため、タグ2.3は空でもよい
            $table->string('tag1');
            $table->string('tag2')->nullable();
            $table->string('tag3')->nullable();

            //文字数制限を指定しないようtext型を使用
            $table->text('body');

            $table->date('date');

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
