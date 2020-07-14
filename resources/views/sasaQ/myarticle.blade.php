@extends('layouts.app')

@section('content')
    <div class="top-wrapper content mx-auto py-3">
        <div class="article col-11 mx-auto py-3">
            <div class="article-header">

                <!-- モーダルの設定 -->
                <!-- tabindex="-1"によってEscキーでモーダルを閉じれるようにする -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">削除確認</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>記事タイトル：「{{$article->title}}」を削除しますか？</p>
                            </div>
                            <div class="modal-footer">
                                <!-- data-dismiss="modal"によって、プラグインを用いてモーダルを閉じている -->
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                <form action="{{route('delete')}}" method="post" class="myarticle-form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="article_id" value="{{$article->article_id}}">
                                    <button type="submit" class="btn btn-primary">削除 <i class="far fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ドロップダウンメニュー -->
                <div class="article-title-right float-right dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form action="{{route('edit')}}" method="post" class="myarticle-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="article_id" value="{{$article->article_id}}">
                        <button type="submit" class="myarticle-form-button">編集 <i class="far fa-edit"></i></button>
                    </form>
                    <button type="button" class="myarticle-form-button" data-toggle="modal" data-target="#deleteModal">削除 <i class="far fa-trash-alt"></i></button>
                </div>

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