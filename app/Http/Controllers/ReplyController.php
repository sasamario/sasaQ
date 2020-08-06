<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Service\ReplyService;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $editReply = $this->replyService->editReply($request);

        //editReplyがnullの時（他のユーザーが編集ボタンを押したとき）はホームにリダイレクトする
        if ($editReply == null) {
            return redirect()->route('home');
        } else {
            return view('sasaQ.editReply', compact('editReply'));
        }
    }

    /**
     * @param ReplyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReplyRequest $request)
    {
        $this->replyService->updateReply($request);

        return redirect()->route('mypage');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $this->replyService->deleteRepley($request);

        return redirect()->route('mypage');
    }
}
