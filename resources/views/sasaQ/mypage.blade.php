@extends('layouts.app')

@section('content')
    <div class="top-wrapper content mx-auto py-3">
        <p class="my-article-title">今までの投稿記事</p>
        @foreach ($myArticles as $item)
            <div class="article-box col-11 mx-auto py-3">
                <div class="article-title">
                    <a class="title" href="{{route('show', ['id' => $item->article_id])}}">{{$item->title}}</a>
                    <div class="article-title-right float-right dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="{{route('edit')}}" method="post" class="mypage-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="article_id" value="{{$item->article_id}}">
                            <button type="submit" class="mypage-form-button">編集 <i class="far fa-edit"></i></button>
                        </form>
                        <form action="#" method="post" class="mypage-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="article_id" value="{{$item->article_id}}">
                            <button type="submit" class="mypage-form-button">削除 <i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                <div class="article-date">
                    {{$item->date}}
                </div>
            </div>
        @endforeach
    </div>
@endsection