@extends('layouts.app')

@section('content')
    <div class="top-wrapper content mx-auto py-3">
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