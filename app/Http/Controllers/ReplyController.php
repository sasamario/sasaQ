<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
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
     * @param ReplyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(ReplyRequest $request)
    {
        $this->replyService->addReply($request);

        return redirect()->route('show', ['id' => $request->article_id]);
    }
}
