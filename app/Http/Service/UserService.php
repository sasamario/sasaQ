<?php

namespace App\Http\Service;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @return Collection
     */
    public function showMyArticles(): Collection
    {
        return User::find(Auth::id())->articles;
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
            ->paginate(5);
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