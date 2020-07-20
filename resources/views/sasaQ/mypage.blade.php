@extends('layouts.app')

@include('layouts.error')

@section('content')
    <div class="mypage-wrapper row">
        <div class="mypage-left-wrapper col-7">
            <div class="mypage-article-wrapper">
                <p class="my-article-title">今までの投稿記事</p>
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
            </div>
        </div>

        <div class="mypage-right-wrapper col-4">
            <div class="user-box col-11 mx-auto clearfix">
                <div class="user-left-box float-left col-5">
                    <div class="user-icon">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <p class="user-name">{{ Auth::user()->name }}さん</p>
                </div>
                <div class="user-right-box float-right col-5">
                    <p class="article-count">投稿数：{{$myArticlesCount}}</p>
                    <p class="reply-count">返信数：{{$myRepliesCount}}</p>
                </div>
            </div>

            <div class="replies-box">

            </div>
        </div>
    </div>d
@endsection