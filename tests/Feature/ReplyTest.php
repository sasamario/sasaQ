<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
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
    public function コメント追加処理テスト()
    {
        $this->dummyLogin();

        //記事投稿者用アカウントの生成
        $user = factory(User::class)->create();

        //コメント送信にあたって、まず記事を準備する必要がある。後のコメント投稿確認を行う際に、記事投稿者名取得にidが必要なため指定する
        $article = factory(Article::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->post(route('addReply'), [
            'body' => 'テストコメント',
            'article_id' => $article->article_id,
        ]);
        $response->assertRedirect(route('show', [
            'id' => $article->article_id,
        ]));

        //コメント投稿されているか確認
        $this->get(route('show', [
            'id' => $article->article_id,
        ]))->assertSee('テストコメント');
    }
}
