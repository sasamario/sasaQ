<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

///ゲストログインのルート
Route::get('/login/guest', 'Auth\LoginController@guestLogin');

//Twitterログインでのルート
Route::get('/auth/twitter', 'Auth\TwitterController@redirectToProvider');
Route::get('/auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');
Route::get("/auth/twitter/logout","Auth\TwitterController@logout");

//Googleログインでのルート
Route::get('/login/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('/login/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('/google/logout', 'Auth\GoogleController@logout');

Auth::routes();

Route::get('/home', 'ArticleController@read')->name('home');

//投稿フォームへのルート
Route::get('/create', 'ArticleController@create')->name('create');

//投稿内容追加のルート
Route::post('/add', 'ArticleController@add')->name('add');

//指定ID記事へのルート
Route::get('/article/{id}', 'ArticleController@show')->name('show');

//返信内容追加のルート
Route::post('/article/reply', 'ReplyController@add')->name('addReply');

//マイページへのルート　返信数取得のためUserControllerからリレーションを用いて取得している
Route::get('/mypage', 'UserController@showMyPage')->name('mypage');

//マイページの記事へのルート
Route::get('/mypage/myarticle/{id}', 'ArticleController@showMyPageArticle')->name('myarticle');

//編集ページへのルート
Route::post('/mypage/article/edit', 'ArticleController@edit')->name('edit');

//編集ページで入力に誤りがあった場合のリダイレクト時のルート　バリデーション実行後、getでリダイレクトされるため
Route::get('/mypage/article/edit', function() {
   return redirect()->route('mypage')->with('editErrorMessage', 'タイトル・タグ・本文は必ず入力してください（編集は完了していません）');
});

//更新時のルート
Route::post('/mypage/article/update', 'ArticleController@update')->name('update');

//削除時のルート
Route::post('/mypage/article/delete', 'ArticleController@delete')->name('delete');

//検索時のルート
Route::get('/search', 'ArticleController@search')->name('search');

//タグ検索時のルート
Route::get('/searchTag/{tag}', 'ArticleController@searchTag')->name('searchTag');

//返信コメントの編集ページへのルート
Route::post('/mypage/reply/edit', 'ReplyController@edit')->name('editReply');

//編集ページで入力に誤りがあった場合のリダイレクト時のルート
Route::get('/mypage/reply/edit', function() {
   return redirect()->route('mypage')->with('editErrorMessage', '本文は必ず入力してください（編集は完了していません）');
});

//返信コメントの更新時のルート
Route::post('/mypage/reply/update', 'ReplyController@update')->name('updateReply');

//返信コメントの削除時のルート
Route::post('/mypage/reply/delete', 'ReplyController@delete')->name('deleteReply');

//ブックマーク追加時のルート
Route::post('/addBookmark', 'BookmarkController@add')->name('addBookmark');

//ブックマーク削除時のルート
Route::post('/deleteBookmark', 'BookmarkController@delete')->name('deleteBookmark');

//ブックマーク一覧ページへのルート
Route::get('/bookmark', 'ArticleController@showMyBookmark')->name('myBookmark');

//下書き一覧ページへのルート
Route::get('/draft', 'ArticleController@readDraft')->name('draft');

//下書き記事へのルート
Route::get('/draft/article/{id}', 'ArticleController@showDraft')->name('showDraft');
