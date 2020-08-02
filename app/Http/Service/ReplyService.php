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

    /**
     * @param Request $request
     * @return Reply
     */
    public function editReply(Request $request): Reply
    {
        return Reply::find($request->reply_id);
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
}