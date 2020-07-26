<?php

namespace App\Http\Service;

use App\Http\Requests\ReplyRequest;
use App\Reply;
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
}