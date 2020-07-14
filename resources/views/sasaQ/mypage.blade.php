@extends('layouts.app')

@include('layouts.error')

@section('content')
    <div class="top-wrapper user-wrapper">
        <div class="user-box col-11 mx-auto">
            <div class="user-right-box float-left col-5">
                <div class="user-icon">
                    <i class="fas fa-user fa-5x"></i>
                </div>
                <p class="user-name">〇〇さん</p>
            </div>
            <div class="user-info float-right col-7">
                <p class="article-count">記事投稿数：{{$count}}</p>
            </div>
        </div>
    </div>

    <div class="top-wrapper">
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
@endsection