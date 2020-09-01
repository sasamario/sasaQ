<?php

namespace App\Http\Controllers;

use App\Http\Service\BookmarkService;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * @var BookmarkService
     */
    private $bookmarkService;

    /**
     * BookmarkController constructor.
     * @param BookmarkService $bookmarkService
     */
    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     */
    public function add(Request $request)
    {
        $this->bookmarkService->addBookmark($request);
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $this->bookmarkService->deleteBookmark($request);
    }
}
