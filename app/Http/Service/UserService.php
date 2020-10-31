<?php

namespace App\Http\Service;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

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
            ->paginate(8, ["*"], 'replypage')
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

    /**
     * @param UserRequest $request
     */
    public function updateProfile(UserRequest $request): void
    {
        if ($request->avatar == null) {
            $avatarPath = Auth::user()->avatar;
        } else {
            $avatar = $request->file('avatar');

            //imagesというファイルに、第二引数に指定した画像を保存する
            $path = Storage::disk('s3')->putFile('images', $avatar, 'public');

            //アップロードした画像のフルパスを取得
            $avatarPath = Storage::disk('s3')->url($path);
        }

        User::where('id', Auth::id())
            ->update([
               'name' => $request->name,
               'avatar' => $avatarPath,
            ]);
    }
}
