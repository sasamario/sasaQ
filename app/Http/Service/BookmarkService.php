<?php

namespace App\Http\Service;

use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkService
{
    /**
     * @param Request $request
     */
    public function addBookmark(Request $request): void
    {
        Bookmark::create([
            'user_id' => Auth::id(),
            'article_id' => $request->articleId,
        ]);
    }

    /**
     * @param Request $request
     */
    public function deleteBookmark(Request $request): void
    {
        Bookmark::where('article_id', $request->articleId)->where('user_id', Auth::id())->delete();
    }
}
