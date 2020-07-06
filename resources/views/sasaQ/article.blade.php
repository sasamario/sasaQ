@extends('layouts.app')

@section('content')
    <div class="top-wrapper content mx-auto py-3">
        <div class="article col-11 mx-auto py-3">
            <div class="article-header">
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
            <div class="article-body">
                {{$article->body}}
            </div>
        </div>
    </div>
@endsection