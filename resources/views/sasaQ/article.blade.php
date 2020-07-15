@extends('layouts.app')

@section('content')
    <div class="top-wrapper">
        <div class="article col-11 mx-auto py-3">
            <div class="article-header">
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

@section('reply-form')
    <div class="reply-wrapper">
        <p class="form-title">返信フォーム</p>
        <div class="reply-form">
            <form action="#" method="post">
                {{ csrf_field() }}
                <textarea class="reply-body" style="width:100%;" name="body" cols="30" rows="3" placeholder="テキストを入力"></textarea>
                <div class="text-right">
                    <input class="reply-button" type="submit" value="返信">
                </div>
            </form>
        </div>
    </div>
@endsection