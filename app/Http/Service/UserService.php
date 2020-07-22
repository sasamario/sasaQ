<?php

namespace App\Http\Service;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function showMyArticles(): LengthAwarePaginator
    {
        return User::join('articles', 'users.id', '=', 'articles.user_id')
            ->where('id', Auth::id())
            ->orderBy('articles.created_at', 'desc')
            ->paginate(10, ["*"], 'articlepage')
            ->appends(["replypage" => Request::get('replypage')]); //ページネーションリンクにクエリ文字(例：replypage=2)を追加　
    }

    /**
     * @return LengthAwarePaginator
     */
    public function showMyReplies(): LengthAwarePaginator
    {
        //リレーションでは、paginateの実装が難しいためjoinメソッドを使用
        return User::join('replies', 'users.id', '=', 'replies.user_id')
            ->where('id', Auth::id())
            ->orderBy('replies.created_at', 'desc')
            ->paginate(10, ["*"], 'replypage')
            ->appends(["articlepage" => Request::get('articlepage')]);
    }

    /**
     * @return int
     */
    public function countMyArticles(): int
    {
        return User::find(Auth::id())->articles->count();
    }

    /**
     * @return int
     */
    public function countMyReplies(): int
    {
        return User::find(Auth::id())->replies->count();
    }
}