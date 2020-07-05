@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{$article->title}}
        </div>
        <div class="card-body">
            {{$article->body}}
        </div>
    </div>
@endsection