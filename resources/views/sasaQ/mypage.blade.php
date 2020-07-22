@extends('layouts.app')

@include('layouts.error')

@section('content')
    <div class="mypage-wrapper row">
        <!-- タブレットサイズ以上であればmd-7:md-4 それ以下の画面サイズでは1:1 -->
        <div class="mypage-left-wrapper mx-auto col-10 col-md-7">
            <div class="user-box mx-auto clearfix">
                <div class="user-left-box float-left col-5">
                    <div class="user-icon">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <p class="user-name">{{ Auth::user()->name }}さん</p>
                </div>
                <div class="user-right-box float-right col-5">
                    <p class="article-count">総投稿数：{{$myArticlesCount}}</p>
                    <p class="reply-count">総返信数：{{$myRepliesCount}}</p>
                </div>
            </div>

            <div class="mypage-article-wrapper">
                <p class="articles-title">今までの投稿記事</p>
                @foreach ($myArticles as $item)
                    <div class="article-box col-11 mx-auto py-3">
                        <div class="article-title">
                            <a class="title" href="{{route('myarticle', ['id' => $item->article_id])}}">{{$item->title}}</a>
                        </div>
                        <div class="article-date">
                            {{$item->date}}
                        </div>
                    </div>
                @endforeach
                <div class="articles-paginate row justify-content-center mt-4">
                    {{ $myArticles->links() }}
                </div>
            </div>
        </div>

        <div class="mypage-right-wrapper mx-auto col-10 col-md-4">
            <div class="replies-box">
                <p class="replies-title">今までのコメント</p>
                @foreach ($myReplies as $reply)
                    <div class="reply-box col-11 mx-auto py-3">
                        <div class="reply-time">{{$reply->created_at}}</div>
                        <div class="reply-body">
                            {{$reply->body}}
                        </div>
                    </div>
                @endforeach
                <div class="replies-paginate row justify-content-center mt-4">
                    {{ $myReplies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection