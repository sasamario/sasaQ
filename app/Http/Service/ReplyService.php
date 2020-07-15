<?php

namespace App\Http\Service;

use App\Reply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyService
{
    /**
     * @param Request $request
     */
    public function addReply(Request $request): void
    {
        Reply::create([
            'user_id' => Auth::id(),
            'article_id' => $request->article_id,
            'body' => $request->body,
            'reply_time' => Carbon::now(),
        ]);
    }
}