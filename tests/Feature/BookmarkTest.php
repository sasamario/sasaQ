<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ダミーログイン処理
     */
    public function dummyLogin()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->withSession(['user_id', $user->id])
            ->get(route('home'));

        return $user;
    }

    /**
     * @test
     */
    public function ブックマーク追加処理テスト()
    {
        $this->dummyLogin();

        $article = factory(Article::class)->create();

        $this->post(route('addBookmark'), [
           'articleId' => $article->article_id,
        ]);

        $this->assertDatabaseHas('bookmarks', [
           'article_id' => $article->article_id,
        ]);
    }
}
