<?php

namespace Tests\Feature;

use App\Article;
use App\Reply;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
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
    public function マイページへアクセステスト()
    {
        $user = $this->dummyLogin();

        $article = factory(Article::class)->create([
           'user_id' => $user->id,
        ]);

        $reply = factory(Reply::class)->create([
           'user_id' => $user->id,
        ]);

        $response = $this->get(route('mypage'));
        $response->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee('総投稿数：1')
            ->assertSee('総返信数：1')
            ->assertSee($article->title)
            ->assertSee($reply->body);
    }
}
