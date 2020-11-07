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

    /**
     * @test
     */
    public function プロフィール編集ページへアクセステスト()
    {
        $user = $this->dummyLogin();

        $response = $this->get(route('editProfile'));
        $response->assertStatus(200)
            ->assertSee('プロフィール編集フォーム')
            ->assertSee('名前（必須）')
            ->assertSee($user->name)
            ->assertSee('プロフィール画像選択');
    }

    /**
     * @test
     */
    public function プロフィール更新処理テスト()
    {
        $user = $this->dummyLogin();

        //画像ありでテストをすると、テストのたびにS3に保存してしまうため今回は名前のみ変更
        $response = $this->post(route('updateProfile'), [
            'name' => '名前変更さん',
        ]);
        $response->assertRedirect(route('mypage'));

        $this->assertDatabaseHas('users', [
            'name' => '名前変更さん',
        ])->assertDatabaseMissing('users', [
            'name' => $user->name,
        ]);
    }
}
