@extends('layouts.app')

@section('content')
<div class="top-wrapper content mx-auto" style="width:60%;">
    @foreach ($articles as $item)
        <div class="article-box col-10 mx-auto py-3">
            <div class="article-title">
                <a class="title" href="{{route('show', ['id' => $item->article_id])}}">{{$item->title}}</a>
            </div>
            <div class="article-date">
                {{$item->date}}
            </div>
        </div>
    @endforeach
</div>
@endsection
