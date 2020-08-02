<?php

namespace App\Http\Service;

use App\Http\Requests\ReplyRequest;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyService
{
    /**
     * @param ReplyRequest $request
     */
    public function addReply(ReplyRequest $request): void
    {
        Reply::create([
            'user_id' => Auth::id(),
            'article_id' => $request->article_id,
            'body' => $request->body,
        ]);
    }

    public function editReply(Request $request)
    {
        return Reply::where('user_id', Auth::id())->find($request->reply_id);
    }

    /**
     * @param ReplyRequest $request
     */
    public function updateReply(ReplyRequest $request): void
    {
        Reply::where('reply_id', $request->reply_id)
            ->where('user_id', Auth::id())
            ->update(['body' => $request->body]);
    }

    /**
     * @param Request $request
     */
    public function deleteRepley(Request $request): void
    {
        Reply::where('reply_id', $request->reply_id)->where('user_id', Auth::id())->delete();
    }
}