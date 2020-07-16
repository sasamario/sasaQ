<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;
use Illuminate\Http\Request;

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
        $myArticlesCount = $this->userService->countMyArticles();
        $myRepliesCount = $this->userService->countMyReplies();

        return view('sasaQ.mypage', compact('myArticles', 'myArticlesCount', 'myRepliesCount'));

    }
}