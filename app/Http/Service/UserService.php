<?php

namespace App\Http\Service;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @return Collection
     */
    public function showMyArticles(): Collection
    {
        return User::find(Auth::id())->articles;
    }

    /**
     * @return int
     */
    public function countMyArticles(): int
    {
        return User::find(Auth::id())->articles->count();
    }

    /**
     * @return int
     */
    public function countMyReplies(): int
    {
        return User::find(Auth::id())->replies->count();
    }
}