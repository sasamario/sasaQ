@extends('layouts.app')

@include('layouts.error')

@section('content')
    <div class="top-wrapper">
        <div class="article col-11 mx-auto py-3">
            <div class="article-header">
                <div class="article-up-detail">
                    <div class="writer-name">投稿者：{{$writerName}}</div>
                    <div class="article-up-date">{{$article->date}}</div>
                </div>
                <div class="title">
                    {{$article->title}}
                </div>
                <div class="tags">
                    <div class="tag">
                        <a href="{{route('searchTag', ['tag' => $article->tag1])}}">{{$article->tag1}}</a>
                    </div>
                    @if ($article->tag2)
                        <div class="tag">
                            <a href="{{route('searchTag', ['tag' => $article->tag2])}}">{{$article->tag2}}</a>
                        </div>
                    @endif

                    @if ($article->tag3)
                        <div class="tag">
                            <a href="{{route('searchTag', ['tag' => $article->tag3])}}">{{$article->tag3}}</a>
                        </div>
                    @endif
                </div>
            </div>
{{--            ※注意　{{$article->body}}の前に空白が存在すると、pre要素になってしまい文の始めが意図しない表示になる--}}
            <div class="article-body markdown">{{$article->body}}</div>

            <div id="app">
{{--                v-bind箇所でfalseになると、「The value for a v-bind expression cannot be empty」とエラーが出る。文字列にしたところ大丈夫なため、三項演算子で文字列を指定--}}
                <bookmark-component :article-id="{{ $article->article_id }}" :is-bookmark="{{ $isBookmark ? 'true' : 'false' }}"></bookmark-component>
            </div>
        </div>
    </div>
@endsection

@section('replies')
    <div class="replies-wrapper">
        <p class="replies-title col-11 mx-auto"><i class="fas fa-comments"></i> コメント</p>
        @if ($isReplies)
            <p class="no-reply col-11 mx-auto">コメントはありません</p>
        @endif
        @foreach ($replies as $reply)
            <div class="reply-box col-11 mx-auto py-3">
                <div class="reply-time">{{$reply->created_at}}</div>
                <div class="reply-comment">{{$reply->body}}</div>
            </div>
        @endforeach
    </div>
@endsection

@section('reply-form')
    <div class="reply-wrapper">
        <p class="form-title">返信フォーム</p>
        <div class="reply-form">
            <form action="{{route('addReply')}}" method="post">
                @csrf
                <textarea class="reply-body" name="body" cols="30" rows="3" placeholder="テキストを入力"></textarea>
                <div class="text-right">
                    <input type="hidden" name="article_id" value="{{$article->article_id}}">
                    <input class="reply-button" type="submit" value="返信">
                </div>
            </form>
        </div>
    </div>
@endsection
