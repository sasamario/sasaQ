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
     * ログイン画面へアクセス
     */
    public function testLoginView()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        //認証されていないことを確認
        $this->assertGuest();
    }

    /**
     * ホーム画面へアクセス（未ログイン状態）し、ログイン画面へリダイレクト
     */
    public function testNonLoginAccess()
    {
        $response = $this->get('/home');
        $response->assertStatus(302)
            ->assertRedirect('/login'); //リダイレクト先を確認
        $this->assertGuest();
    }

    /**
     * ホーム画面へアクセス（ログイン状態）
     */
    public function testLogin()
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
     * 投稿ページへアクセス
     */
    public function testCreatePage()
    {
        $this->dummyLogin();

        $response = $this->get('/create');
        $response->assertStatus(200);
    }

    /**
     * マイページへアクセス
     */
    public function testMyPage()
    {
        $this->dummyLogin();
        $response = $this->get(route('mypage'));
        $response->assertSee(200);
    }

    /**
     * ブックマーク一覧ページへアクセス
     */
    public function testBookmarkPage()
    {
        $this->dummyLogin();
        $response = $this->get(route('myBookmark'));
        $response->assertStatus(200);
    }
}
