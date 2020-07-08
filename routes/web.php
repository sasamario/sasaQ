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

Auth::routes();

Route::get('/home', 'ArticleController@read')->name('home');

//投稿フォームへのルート
Route::get('/create', 'ArticleController@create')->name('create');

//投稿内容追加のルート
Route::post('/add', 'ArticleController@add')->name('add');

//指定ID記事へのルート
Route::get('/article/{id}', 'ArticleController@show')->name('show');

//マイページへのルート
Route::get('/mypage', 'ArticleController@showMyPage')->name('mypage');