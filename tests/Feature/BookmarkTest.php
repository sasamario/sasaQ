<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ダミーログイン処理
     */
    public function dummyLogin()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->withSession(['user_id', $user->id])
            ->get(route('home'));

        return $user;
    }
}
