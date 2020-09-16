<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 記事追加処理のテスト
     *
     * @return void
     */
    public function testAdd()
    {
        $article = new Article;
        $article->user_id = 1;
        $article->title = 'タイトルテスト';
        $article->tag1 = 'タグテスト';
        $article->body = '本文テスト';
        $article->date = '2020-09-15';
        $article->status = 1;
        $article->save();

        $this->assertDatabaseHas('articles', [
            'user_id' => 1,
            'title' => 'タイトルテスト',
            'tag1' => 'タグテスト',
            'body' => '本文テスト',
            'date' => '2020-09-15',
            'status' => 1
        ]);
    }


}
