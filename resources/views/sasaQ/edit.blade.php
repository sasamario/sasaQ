@extends('layouts.app')

@include('layouts.helpmodal')

@section('content')
    <form action="{{route('update')}}" method="post">
        {{ csrf_field() }}
        <input type="text" class="form-control m-1" id="title-input" placeholder="タイトル" name="title" value="{{$editArticle->title}}">
        <input type="text" class="form-control m-1" placeholder="プログラミング技術に関するタグをスペース区切りで3つまで入力" name="tags" value="{{$editArticle->tag1}} {{$editArticle->tag2}} {{$editArticle->tag3}}">
        <div class="row justify-content-center mx-1">
            <div class="col-6 p-0">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">本文</div>
                        <div class="float-right help-button" data-toggle="modal" data-target="#helpModal"><i class="far fa-question-circle"></i></div>
                    </div>
                    <textarea class="card-body p-1" name="body" id="markdown_editor_textarea" cols="30" rows="15" class="form-control">{{$editArticle->body}}</textarea>
                </div>
            </div>
            <div class="col-6 p-0">
                <div class="card">
                    <div class="card-header">
                        プレビュー
                    </div>
{{--                    Todo：キー入力しないとプレビューが表示されないため要修正--}}
                    <div class="card-body markdown p-1" id="markdown_preview">本文入力欄にてキー入力するとプレビュー表示されます！</div>
                </div>
            </div>
        </div>
        <div class="post-page-footer">
            <input type="hidden" name="article_id" value="{{$editArticle->article_id}}">
            <input type="submit" class="post-button m-1" value="更新">
        </div>
    </form>
@endsection