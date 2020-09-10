@extends('layouts.app')

@include('layouts.error')

@include('layouts.helpmodal')

@section('content')
<form action="{{route('add')}}" method="post">
    @csrf
    <input type="text" class="form-control m-1" id="title-input" placeholder="タイトル" name="title" value="{{ old('title') }}">
    <input type="text" class="form-control m-1" placeholder="プログラミング技術に関するタグをスペース区切りで3つまで入力" name="tags" value="{{ old('tags') }}">
    <div class="row justify-content-center mx-1">
        <div class="col-6 p-0">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">本文</div>
                    <div class="float-right help-button" data-toggle="modal" data-target="#helpModal"><i class="far fa-question-circle"></i></div>
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
