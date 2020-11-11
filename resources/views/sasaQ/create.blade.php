@extends('layouts.app')

@include('layouts.error')

@include('layouts.helpmodal')

@section('content')
<form action="{{route('add')}}" method="post">
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
    </div>

    <input type="text" class="form-control m-1" id="title-input" placeholder="タイトル（必須）" name="title" value="{{ old('title') }}">
    <input type="text" class="form-control m-1" placeholder="タグを半角スペース区切りで3つまで入力（最低１つ必須）" name="tags" value="{{ old('tags') }}">
    <div class="row justify-content-center mx-1">
        <div class="col-6 p-0">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">本文</div>
                    <div class="float-right">
                        <div class="template-button" id="template"><i class="far fa-file-alt" data-toggle="tooltip" title="質問テンプレート作成"></i></div>
                        <div class="help-button" data-toggle="modal" data-target="#helpModal"><i class="far fa-question-circle" data-toggle="tooltip" title="マークダウン記法確認"></i></div>
                    </div>
                </div>
                <textarea class="card-body p-1" name="body" id="markdown_editor_textarea" cols="30" rows="15" class="form-control">{{ old('body') }}</textarea>
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
        <label>
            <input type="radio" name="status" value="{{ \App\Article::STATUS_POST }}" checked>投稿
        </label>
        <label>
            <input type="radio" name="status" value="{{ \App\Article::STATUS_DRAFT }}">下書き
        </label>
        <input type="submit" class="post-button m-1" value="投稿">
    </div>
</form>
@endsection
