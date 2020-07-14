<?php

namespace App\Http\Controllers;

use App\Http\Service\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('sasaQ.create');
    }

    public function add(Request $request)
    {
        $this->articleService->addArticle($request);

        return redirect()->route('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function read()
    {
        $articles = $this->articleService->readArticles();

        return view('home', compact('articles'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $article = $this->articleService->showArticle($id);

        return view('sasaQ.article', compact('article'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMyPage()
    {
        $myArticles = $this->articleService->showMyArticles();
        $count = $this->articleService->countMyArticles();

        return view('sasaQ.mypage', compact('myArticles', 'count'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMyPageArticle(int $id)
    {
        $article = $this->articleService->showMyArticle($id);

        return view('sasaQ.myarticle', compact('article'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $editArticle = $this->articleService->editArticle($request);

        return view('sasaQ.edit', compact('editArticle'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->articleService->updateArticle($request);

        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $this->articleService->deleteArticle($request);

        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $articles = $this->articleService->searchArticles($request);
        $count = $this->articleService->countArticles($request);

        return view('sasaQ.search', compact('articles', 'count'));
    }
}
