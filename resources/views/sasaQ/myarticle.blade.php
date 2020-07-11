@extends('layouts.app')

@section('content')
    <div class="top-wrapper content mx-auto py-3">
        <div class="article col-11 mx-auto py-3">
            <div class="article-header">
                <div class="article-title-right float-right dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form action="{{route('edit')}}" method="post" class="mypage-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="article_id" value="{{$article->article_id}}">
                        <button type="submit" class="mypage-form-button">編集 <i class="far fa-edit"></i></button>
                    </form>
                    <form action="{{route('delete')}}" method="post" class="mypage-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="article_id" value="{{$article->article_id}}">
                        <button type="submit" class="mypage-form-button">削除 <i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
                <div class="article-date">
                    {{$article->date}}
                </div>
                <div class="title">
                    {{$article->title}}
                </div>
                <div class="tags">
                    <div class="tag">
                        {{$article->tag1}}
                    </div>
                    @if ($article->tag2)
                        <div class="tag">
                            {{$article->tag2}}
                        </div>
                    @endif

                    @if ($article->tag3)
                        <div class="tag">
                            {{$article->tag3}}
                        </div>
                    @endif
                </div>
            </div>
            {{--            ※注意　{{$article->body}}の前に空白が存在すると、pre要素になってしまい文の始めが意図しない表示になる--}}
            <div class="article-body markdown">{{$article->body}}</div>
        </div>
    </div>
@endsection