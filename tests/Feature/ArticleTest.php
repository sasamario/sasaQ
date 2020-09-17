<?php

namespace Tests\Feature;

use App\Article;
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
}
