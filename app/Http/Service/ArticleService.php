<?php

namespace App\Http\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    /**
     * @param Request $request
     */
    public function addArticle(Request $request): void
    {
        //explode関数でスペースを区切り文字として分割する
        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;

        Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'tag1' => $tag1,
            'tag2' => $tag2,
            'tag3' => $tag3,
            'body' => $request->body,
            'date' =>now(),
        ]);
    }

    /**
     * @return Collection
     * トップページの記事データ取得の処理
     */
    public function readArticles(): Collection
    {
        return Article::orderBy('date', 'desc')->get();
    }

    /**
     * @param int $id
     * @return Article
     * 指定の記事IDのデータ取得処理
     */
    public function showArticle(int $id): Article
    {
        return Article::find($id);
    }

    /**
     * @return Collection
     */
    public function showMyArticles(): Collection
    {
        return Article::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
    }

    /**
     * @param int $id
     * @return Article
     * マイページからの指定記事IDのデータ取得処理　編集など行えるページのためログイン中のユーザーかどうか確認の処理を実装
     */
    public function showMyArticle(int $id): Article
    {
        return Article::where('user_id', Auth::id())->find($id);
    }

    /**
     * @param Request $request
     * @return Article
     */
    public function editArticle(Request $request): Article
    {
        return Article::find($request->article_id);
    }

    /**
     * @param Request $request
     */
    public function updateArticle(Request $request): void
    {
        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;

        Article::where('article_id', $request->article_id)
            ->update([
                'title' => $request->title,
                'tag1' => $tag1,
                'tag2' => $tag2,
                'tag3' => $tag3,
                'body' => $request->body,
            ]);
    }

    /**
     * @param Request $request
     */
    public function deleteArticle(Request $request): void
    {
        Article::where('article_id', $request->article_id)->where('user_id', Auth::id())->delete();
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function searchArticles(Request $request): Collection
    {
        return Article::where('title', 'LIKE', "%{$request->search}%")->orderBy('date', 'desc')->get();
    }

    /**
     * @param Request $request
     * @return int
     */
    public function countArticles(Request $request): int
    {
        return Article::where('title', 'LIKE', "%{$request->search}%")->count();
    }
}
