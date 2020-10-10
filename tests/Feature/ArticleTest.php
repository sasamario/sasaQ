<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

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
            "status" => Article::STATUS_POST,
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
            "status" => Article::STATUS_DRAFT,
        ]);

        $response->assertRedirect(route('home'));

        //下書き一覧ページで下書き記事タイトルが表示されていることを確認
        $this->get(route('draft'))
            ->assertSee('テスト下書きタイトル');

        //マイページで追加した記事タイトルが表示されているか確認
        $this->get(route('mypage'))
            ->assertSee('テスト下書きタイトル');
    }

    /**
     * @test
     */
    public function ステータス「投稿」時の記事更新処理テスト()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->withSession(['user_id', $user->id])
            ->get(route('home'));

        //更新処理ではログイン中のユーザーでしかできない仕様のため、ファクトリでuser_idの値をオーバーライドする
        $article = factory(Article::class)->create([
            'user_id' =>$user->id,
            'status' => Article::STATUS_POST,
        ]);

        //データベースにデータが登録されていることを確認
        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
        ]);

        $response = $this->post(route('update'), [
            'importance' => '0',
            'title' => '更新処理テストタイトル（投稿）',
            'tags' => '更新 テスト',
            'body' => '更新処理完了',
            'article_id' => $article->article_id,
            //ステータスが「投稿」の場合は、編集画面でステータスの変更はできない仕様のため、ここでの処理では記載しない
        ]);

        $response->assertRedirect(route('mypage'));

        $this->assertDatabaseHas('articles', [
            'title' => '更新処理テストタイトル（投稿）',
        ]);
    }

    /**
     * @test
     */
    public function ステータス「下書き」から「投稿」へ記事更新処理テスト()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->withSession(['user_id', $user->id])
            ->get(route('home'));

        //更新処理ではログイン中のユーザーでしかできない仕様のため、ファクトリでuser_idの値をオーバーライドする
        $article = factory(Article::class)->create([
            'user_id' =>$user->id,
            'status' => Article::STATUS_DRAFT,
        ]);

        //データベースにデータが登録されていることを確認
        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
        ]);

        $response = $this->post(route('update'), [
            'importance' => '0',
            'title' => '更新処理テストタイトル（下書き）',
            'tags' => '更新 テスト',
            'body' => '更新処理完了',
            'article_id' => $article->article_id,
            'status' => Article::STATUS_POST,
        ]);

        $response->assertRedirect(route('mypage'));

        $this->assertDatabaseHas('articles', [
            'title' => '更新処理テストタイトル（下書き）',
        ]);
    }
    
    /**
     * @test
     */
    public function 記事削除処理テスト()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->withSession(['user_id', $user->id])
            ->get(route('home'));

        $article = factory(Article::class)->create([
            'user_id' => $user->id,
        ]);

        //データベースにデータが登録されていることを確認
        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
        ]);

        $response = $this->post(route('delete'), [
            'article_id' => $article->article_id,
        ]);

        $response->assertRedirect(route('mypage'));

        //データがテーブルから削除されていることを確認
        $this->assertDatabaseMissing('articles', [
            'title' => $article->title,
        ]);
    }
}
