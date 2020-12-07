<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="welcome-body">
        <div class="welcome-header">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="first-content">
            <img class="first-content-image" src="{{asset( '/img/top.png' )}}" alt="first-image">
            <p class="first-content-text">「クールな質問をデータに」</p>
        </div>

        <div class="second-content">
            <div class="second-content-item row">
                <img class="second-content-image col-12 col-md-6" src="{{asset( '/img/question.png' )}}" alt="question">
                <p class="second-content-text col-12 col-md-6"><strong>【課題】</strong><br/>
                コロナウイルスの影響で、リモートワークが推奨されるようになりました。 その結果、対面での質問の機会が減り、チャットベースでの質問が基本となりました。<br/>
                チャットベースでの質問になり以下の点が問題視されています。<br/><br/>
                ◯チャットベースでの質問では自分の「わからないこと」「躓いていること」を伝えることが難しい。<br/><br/>
                ◯個人チャットのようなクローズドなコミュニティでの質問になると他の人から見えないため同じような質問をされる可能性がある。</p>
            </div>
            <div class="second-content-item row">
                <img class="second-content-image col-12 col-md-6" src="{{asset( '/img/solution.png' )}}" alt="team">
                <p class="second-content-text col-12 col-md-6"><strong>【解決策】</strong><br/>
                自分の考え等を伝えることが難しい件については、マークダウン記法を用いることで解決できる。<br/>
                マークダウン記法を用いることで、見出しや強調など文字装飾が簡単にできるのため表現の幅が広がり伝えやすくなる。<br/><br/>
                また、同じ質問を防ぐためにはオープンなコミュニティでかつ社内に質問と回答をデータとして残すことで解決できる。<br/>
                上記の要件を満たすために、社内向け質問アプリケーションの開発を行いました。</p>
            </div>
        </div>
    </body>
</html>
