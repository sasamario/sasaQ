@extends('layouts.app')

@section('content')
<div class="thread content justify-content-center">
    @foreach ($articles as $item)
        <div class="card">
            <div class="card-header">
                <a href="{{route('show', ['id' => $item->article_id])}}">{{$item->title}}</a>
            </div>
            <div class="card-body">
                {{$item->body}}
            </div>
        </div>
    @endforeach
</div>
@endsection
