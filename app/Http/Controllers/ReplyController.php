<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\ReplyService;

class ReplyController extends Controller
{
    /**
     * @var
     */
    private $replyService;

    /**
     * ReplyController constructor.
     * @param ReplyService $replyService
     */
    public function __construct(ReplyService $replyService)
    {
        $this->replyService = $replyService;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Todo:バリデーション要設定！！！
     */
    public function add(Request $request)
    {
        $this->replyService->addReply($request);

        return redirect()->route('show', ['id' => $request->article_id]);
    }
}
