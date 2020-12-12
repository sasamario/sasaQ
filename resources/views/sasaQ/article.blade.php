@extends('layouts.app')

@include('layouts.error')

@include('layouts.helpmodal')

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
{{--                is-bookmark="{{ $isBookmark }}"　だとtrueが1として認識され、falseだとエラーになる　原因が分らない--}}
{{--                v-bind箇所で $isBookmark = false になると、「The value for a v-bind expression cannot be empty」とエラーが出る。''で囲ったら認識された--}}
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
                <div class="reply-up-detail">
                    <div class="replier-name">{{$reply->name}} さん</div>
                    <div class="reply-up-date">{{$reply->created_at}}</div>
                </div>
                <div class="reply-comment reply-markdown">{{$reply->body}}</div>
            </div>
        @endforeach
    </div>
@endsection

@section('reply-form')
    <div class="reply-wrapper my-4">
        <p class="form-title">返信フォーム</p>
        <div class="reply-form">
            <form action="{{route('addReply')}}" method="post">
                @csrf
                <div class="tab-wrap">
                    <div class="image-button">
                        <label for="image">
                            <i class="far fa-image" data-toggle="tooltip" title="画像を選択"></i>
                            <input type="file" name="image" id="image" class="input-file-button">
                        </label>
                    </div>
                    <div class="help-button" data-toggle="modal" data-target="#helpModal"><i class="far fa-question-circle" data-toggle="tooltip" title="マークダウン記法確認"></i></div>
                    <input id="tab-1" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label" for="tab-1">編集</label>
                    <div class="tab-content">
                        <textarea class="reply-body" name="body" id="markdown_editor_textarea" cols="30" rows="5" placeholder="テキストを入力"></textarea>
                    </div>
                    <input id="tab-2" type="radio" name="tab" class="tab-switch preview-check-button"><label class="tab-label" for="tab-2">プレビュー</label>
                    <div class="tab-content">
                        <div class="reply-body-preview reply-markdown"></div>
                    </div>
                </div>
                <div class="text-right">
                    <input type="hidden" name="article_id" value="{{$article->article_id}}">
                    <input class="reply-button" type="submit" value="返信">
                </div>
            </form>
        </div>
    </div>
@endsection
