<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function ログイン画面へアクセス()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        //認証されていないことを確認
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function 未ログイン状態でホーム画面へアクセス()
    {
        $response = $this->get('/home');
        $response->assertStatus(302)
            ->assertRedirect('/login'); //リダイレクト先を確認
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function ログイン状態でホーム画面へアクセス()
    {
        $this->assertGuest();

        $response = $this->dummyLogin();
        $response->assertStatus(200);
        //認証を確認
        $this->assertAuthenticated();
    }

    /**
     * ダミーログイン処理
     * @return \Illuminate\Testing\TestResponse
     */
    public function dummyLogin()
    {
        $user = factory(User::class)->create();

        return  $this->actingAs($user)
            ->withSession(['user_id', $user->id])
            ->get(route('home'));
    }

    /**
     * @test
     */
    public function 投稿ページへアクセス()
    {
        $this->dummyLogin();

        $response = $this->get(route('create'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function マイページへアクセス()
    {
        $this->dummyLogin();
        $response = $this->get(route('mypage'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ブックマーク一覧へアクセス()
    {
        $this->dummyLogin();
        $response = $this->get(route('myBookmark'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function ステータス「投稿」時の追加処理テスト()
    {
        $this->dummyLogin();

        $response = $this->post(route('add'), [
            "importance" => "0",
            "title" => "テストタイトル",
            "tags" => "テスト タグ",
            "body" => "テスト本文",
            "status" => "1",
        ]);

        //投稿処理後ホーム画面にリダイレクトするか確認
        $response->assertRedirect(route('home'));

        //ホーム画面に追加した記事タイトルが表示されているか確認
        $this->get(route('home'))
            ->assertSee('テストタイトル');

        //マイページで追加した記事タイトルが表示されているか確認
        $this->get(route('mypage'))
            ->assertSee('テストタイトル');
    }

    /**
     * @test
     */
    public function ステータス「下書き」時の追加処理テスト()
    {
        $this->dummyLogin();

        $response = $this->post(route('add'), [
            "importance" => "0",
            "title" => "テスト下書きタイトル",
            "tags" => "テスト タグ",
            "body" => "テスト本文",
            "status" => "0",
        ]);

        $response->assertRedirect(route('home'));

        //下書き一覧ページで下書き記事タイトルが表示されていることを確認
        $this->get(route('draft'))
            ->assertSee('テスト下書きタイトル');

        //マイページで追加した記事タイトルが表示されているか確認
        $this->get(route('mypage'))
            ->assertSee('テスト下書きタイトル');
    }
}
