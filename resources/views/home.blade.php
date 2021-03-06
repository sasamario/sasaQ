@extends('layouts.app')

@section('content')
<div class="top-wrapper content mx-auto py-3">
    @foreach ($articles as $item)
        <div class="article-box col-11 mx-auto py-3">
            <div class="row">
                <div class="writer-avatar col-2 col-md-1">
                    @if ($item->avatar == null)
                        <i class="profile-avatar fas fa-user"></i>
                    @else
                        <img class="profile-avatar" src="{{ $item->avatar }}" alt="">
                    @endif
                </div>
                <div class="col-10 col-md-11">
                    <div class="article-title">
                        <a class="title" href="{{route('show', ['id' => $item->article_id])}}">{{$item->title}}</a>
                        <div class="importance-status">
                            @if ($item->importance === \App\Article::STATUS_DONE)
                                【解決】
                            @endif
                        </div>
                    </div>
                    <div class="article-date">
                        {{ $item->name }} さんが {{$item->date}} に投稿
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="articles-paginate row justify-content-center mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
