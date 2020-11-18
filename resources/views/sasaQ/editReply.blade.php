@extends('layouts.app')

@section('reply-form')
    <div class="reply-wrapper">
        <p class="form-title">返信コメント編集フォーム</p>
        <div class="reply-form">
            <form action="{{route('updateReply')}}" method="post">
                @csrf
                <div class="tab-wrap">
                    <input id="tab-1" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label" for="tab-1">編集</label>
                    <div class="tab-content">
                        <textarea class="reply-body" name="body" cols="30" rows="5" placeholder="テキストを入力">{{$editReply->body}}</textarea>
                    </div>
                    <input id="tab-2" type="radio" name="tab" class="tab-switch preview-check-button"><label class="tab-label" for="tab-2">プレビュー</label>
                    <div class="tab-content">
                        <div class="reply-body-preview reply-markdown"></div>
                    </div>
                </div>
                <div class="text-right">
                    <input type="hidden" name="reply_id" value="{{$editReply->reply_id}}">
                    <input class="reply-button" type="submit" value="更新">
                </div>
            </form>
        </div>
    </div>
@endsection
