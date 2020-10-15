<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
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
}
