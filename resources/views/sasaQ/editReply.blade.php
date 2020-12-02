@extends('layouts.app')

@include('layouts.helpmodal')

@section('reply-form')
    <div class="reply-wrapper">
        <p class="form-title">返信コメント編集フォーム</p>
        <div class="reply-form">
            <form action="{{route('updateReply')}}" method="post">
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
                        <textarea class="reply-body textarea-image" name="body" cols="30" rows="5" placeholder="テキストを入力">{{$editReply->body}}</textarea>
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
