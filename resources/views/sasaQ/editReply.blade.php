@extends('layouts.app')

@section('reply-form')
    <div class="reply-wrapper">
        <p class="form-title">返信コメント編集フォーム</p>
        <div class="reply-form">
            <form action="{{route('updateReply')}}" method="post">
                @csrf
                <textarea class="reply-body" name="body" cols="30" rows="3" placeholder="テキストを入力">{{$editReply->body}}</textarea>
                <div class="text-right">
                    <input type="hidden" name="reply_id" value="{{$editReply->reply_id}}">
                    <input class="reply-button" type="submit" value="更新">
                </div>
            </form>
        </div>
    </div>
@endsection
