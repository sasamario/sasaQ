@extends('layouts.app')

@include('layouts.helpmodal')

@section('content')
    <form action="{{route('update')}}" method="post">
        @csrf
        <div class="importance-form form-group">
            <label>
                <input type="radio" name="importance" value="{{ \App\Article::STATUS_NOT_HURRY }}" checked>お手すきに
            </label>
            <label>
                <input type="radio" name="importance" value="{{ \App\Article::STATUS_HURRY }}">急ぎ
            </label>
            <label>
                <input type="radio" name="importance" value="{{ \App\Article::STATUS_OTHER }}">その他
            </label>
            <label>
                <input type="radio" name="importance" value="{{ \App\Article::STATUS_DONE }}">解決済み
            </label>
        </div>

        <input type="text" class="form-control m-1" id="title-input" placeholder="タイトル（必須）" name="title" value="{{$editArticle->title}}">
        <input type="text" class="form-control m-1" placeholder="タグを半角スペース区切りで3つまで入力（最低１つ必須）" name="tags" value="{{$editArticle->tag1}} {{$editArticle->tag2}} {{$editArticle->tag3}}">
        <div class="row justify-content-center mx-1">
            <div class="col-6 p-0">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">本文</div>
                        <div class="float-right">
                            <div class="image-button">
                                <label for="image">
                                    <i class="far fa-image" data-toggle="tooltip" title="画像を選択"></i>
                                    <input type="file" name="image" id="image" class="input-file-button">
                                </label>
                            </div>
                            <div class="help-button" data-toggle="modal" data-target="#helpModal"><i class="far fa-question-circle" data-toggle="tooltip" title="マークダウン記法確認"></i></div>
                        </div>
                    </div>
                    <textarea class="card-body article-textarea p-1" name="body" id="markdown_editor_textarea" cols="30" rows="15" class="form-control">{{$editArticle->body}}</textarea>
                </div>
            </div>
            <div class="col-6 p-0">
                <div class="card">
                    <div class="card-header">
                        プレビュー
                    </div>
                    <div class="card-body markdown p-1" id="markdown_preview"></div>
                </div>
            </div>
        </div>
        <div class="post-page-footer">
{{--            記事のステータスが下書きだった場合、チェックボックスで投稿か下書き保存を選択できる--}}
            @if ($editArticle->status === \App\Article::STATUS_DRAFT)
                <label>
                    <input type="radio" name="status" value="{{ \App\Article::STATUS_POST }}">投稿
                </label>
                <label>
                    <input type="radio" name="status" value="{{ \App\Article::STATUS_DRAFT }}" checked>下書き
                </label>
            @else
                <input type="hidden" name="status" value="{{$editArticle->status}}">
            @endif

            <input type="hidden" name="article_id" value="{{$editArticle->article_id}}">
            <input type="submit" class="post-button m-1" value="更新">
        </div>
    </form>
@endsection
