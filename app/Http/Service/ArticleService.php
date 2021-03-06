<?php

namespace App\Http\Service;

use App\Http\Requests\ArticleRequest;
use App\Notifications\Slack;
use App\Reply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    /**
     * @param ArticleRequest $request
     */
    public function addArticle(ArticleRequest $request): void
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
            'status' => $request->status,
            'importance' => $request->importance
        ]);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function readArticles(): LengthAwarePaginator
    {
        return Article::join('users', 'articles.user_id', '=', 'users.id')
            ->where('articles.status', Article::STATUS_POST)
            ->orWhere('articles.status', null)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(15);
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
     * @param int $id
     * @return string
     */
    public function getArticleWriterName(int $id): string
    {
        return Article::find($id)->user->name;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function showArticleReply(int $id): Collection
    {
        return Reply::join('users', 'replies.user_id', '=', 'users.id')
            ->where('replies.article_id', $id)
            ->orderBy('replies.created_at', 'asc')
            ->select('replies.body', 'replies.created_at', 'users.name')
            ->orderBy('replies.created_at', 'asc')
            ->get();
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

    public function editArticle(Request $request)
    {
        return Article::where('user_id', Auth::id())->find($request->article_id);
    }

    /**
     * @param ArticleRequest $request
     */
    public function updateArticle(ArticleRequest $request): void
    {
        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;

        Article::where('article_id', $request->article_id)
            ->where('user_id', Auth::id())
            ->update([
                'title' => $request->title,
                'tag1' => $tag1,
                'tag2' => $tag2,
                'tag3' => $tag3,
                'body' => $request->body,
                'status' => $request->status,
                'importance' => $request->importance
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
        return Article::where('body', 'LIKE', "%{$request->search}%")->orderBy('created_at', 'desc')->get();
    }

    /**
     * @param Request $request
     * @return int
     */
    public function countArticles(Request $request): int
    {
        return Article::where('body', 'LIKE', "%{$request->search}%")->count();
    }

    /**
     * @param string $tag
     * @return Collection
     */
    public function searchTagArticles(string $tag): Collection
    {
        return Article::where('tag1', '=', $tag)
            ->orWhere('tag2', '=', $tag)
            ->orWhere('tag3', '=', $tag)
            ->get();
    }

    /**
     * @param string $tag
     * @return int
     */
    public function countTagArticles(string $tag): int
    {
        return Article::where('tag1', '=', $tag)
            ->orWhere('tag2', '=', $tag)
            ->orWhere('tag3', '=', $tag)
            ->count();
    }

    /**
     * @param int $id
     * @return bool
     * 記事に対して、ログインユーザーがブックマークしているかどうか判別するための処理
     */
    public function checkBookmark(int $id): bool
    {
        return Article::find($id)->bookmarks->where('user_id', Auth::id())->isNotEmpty();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function showMyBookmarkArticles(): LengthAwarePaginator
    {
        return Article::join('bookmarks', 'articles.article_id', '=', 'bookmarks.article_id')
            ->where('bookmarks.user_id', Auth::id())
            ->orderBy('bookmarks.created_at', 'desc')
            ->paginate(10);
    }

    /**
     * @return int
     */
    public function countMyBookmarkArticles(): int
    {
        return Article::join('bookmarks', 'articles.article_id', '=', 'bookmarks.article_id')
            ->where('bookmarks.user_id', Auth::id())
            ->count();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function readDraftArticles(): LengthAwarePaginator
    {
        return Article::where('user_id', Auth::id())
            ->where('status', Article::STATUS_DRAFT)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    /**
     * @return int
     */
    public function countDraftArticles(): int
    {
        return Article::where('user_id', Auth::id())
            ->where('status', Article::STATUS_DRAFT)
            ->count();
    }

    /**
     * @param ArticleRequest $request
     */
    public function sendSlackNotification(ArticleRequest $request): void
    {
        $user = Auth::user();

        $id = Article::where('user_id', Auth::id())
            ->where('title', $request->title)
            ->where('body', $request->body)
            ->orderBy('created_at', 'desc')
            ->value('article_id');

        $status = Article::where('article_id', $id)->value('importance');

        $user->notify(new Slack($user->name, $request->title, $id, $status));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getImagePath(Request $request): string
    {
        $image = $request->file('image');

        //imagesというファイルに、第二引数に指定した画像を保存する
        $path = Storage::disk('s3')->putFile('images/article', $image, 'public');

        //アップロードした画像のフルパスを取得
        $imagePath = Storage::disk('s3')->url($path);

        return $imagePath;
    }
}
