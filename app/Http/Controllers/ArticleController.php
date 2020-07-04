<?php

namespace App\Http\Controllers;

use App\Http\Service\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->middleware('auth');
    }

    public function create()
    {
        return view('sasaQ.create');
    }

    public function add(Request $request)
    {
        $this->articleService->addArticle($request);

        return redirect()->route('home');
    }
}
