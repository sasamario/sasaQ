<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMyPage()
    {
        $myArticles = $this->userService->showMyArticles();
        $myReplies = $this->userService->showMyReplies();
        $myArticlesCount = $this->userService->countMyArticles();
        $myRepliesCount = $this->userService->countMyReplies();

        return view('sasaQ.mypage', compact('myArticles', 'myReplies', 'myArticlesCount', 'myRepliesCount'));

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('sasaQ.editProfile');
    }
}
