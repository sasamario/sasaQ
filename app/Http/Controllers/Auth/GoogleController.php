<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //Googleの認証ページへユーザーをリダイレクト
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            //認証結果の受け取り
            $user = Socialite::driver('google')->stateless()->user();
        } catch (Exception $e) {
            return redirect('/');
        }

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);

        return redirect()->route('home');
    }

    public function findOrCreateUser($googleUser)
    {
        $authUser = User::where('email', $googleUser->email)->first();

        if ($authUser) {
            return $authUser;
        }

        //DBにユーザー情報がなければ作成する
        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
