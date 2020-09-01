<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
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

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(ArticleRequest $request)
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
        $replies = $this->articleService->showArticleReply($id);
        $isReplies = $this->articleService->showArticleReply($id)->isEmpty();
        $writerName = $this->articleService->getArticleWriterName($id);

        $isBookmark = $this->articleService->checkBookmark($id);

        return view('sasaQ.article', compact('article', 'replies', 'isReplies', 'writerName', 'isBookmark'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $editArticle = $this->articleService->editArticle($request);

        //editArticleがnullの時（他のユーザーが編集ボタンを押したとき）はホームにリダイレクトする
        if ($editArticle == null) {
            return redirect()->route('home');
        } else {
            return view('sasaQ.edit', compact('editArticle'));
        }
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request)
    {
        $this->articleService->updateArticle($request);

        return redirect()->route('mypage');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $this->articleService->deleteArticle($request);

        return redirect()->route('mypage');
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

    /**
     * @param string $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchTag(string $tag)
    {
        $articles = $this->articleService->searchTagArticles($tag);
        $count = $this->articleService->countTagArticles($tag);

        return view('sasaQ.search', compact('articles', 'count'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMyBookmark()
    {
        $articles = $this->articleService->showMyBookmarkArticles();
        $count = $this->articleService->countMyBookmarkArticles();

        return view('sasaQ.bookmark', compact('articles', 'count'));
    }
}
