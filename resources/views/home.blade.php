@extends('layouts.app')

@section('content')
<div class="top-wrapper content mx-auto py-3">
    @foreach ($articles as $item)
        <div class="article-box col-11 mx-auto py-3">
            <div class="article-title">
                <a class="title" href="{{route('show', ['id' => $item->article_id])}}">{{$item->title}}</a>
            </div>
            <div class="article-date">
                {{$item->date}}
            </div>
        </div>
    @endforeach
    <div class="articles-paginate row justify-content-center mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
