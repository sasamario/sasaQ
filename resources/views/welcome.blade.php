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
        <div class="welcome-content">
            <div class="welcome-title">
                Welcome to <strong>sasaQ</strong>
            </div>

            <div class="detail">
                <p><strong>『sasaQ』</strong>は、社内向けの質問サービスです。<br/>
                    新卒エンジニアとして働いてみて、チャットベースの質問では相手に自分の思いを伝えることが難しいと感じました。<br/>
                    実際に、先輩に「何がわからないか伝わらない。マークダウン記法を使って質問するといい」とアドバイスをいただきました。<br/>
                    質問をマークダウン記法を使って取りまとめることで、自分の伝えたいことが整理でき回答者側も的確なアドバイスができると思います。<br/>
                    そういった実体験から、マークダウンの使える質問サービスを開発することにしました。<br/>
                    また、社内向けのサービスのため質問や回答がデータとして蓄積していき、同じ質問で時間を取られることがなくなる点、<br/>
                    マークダウン記法を使用することによる質問力の向上などの効果が期待できます。<br/>
                    <strong>※テストログイン用のアカウントあります。ログインフォームにアクセスお願いいたします。</strong></p>
            </div>
        </div>
    </body>
</html>
