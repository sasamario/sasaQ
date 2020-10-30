@extends('layouts.app')

@include('layouts.error')

@section('content')
    <div class="top-wrapper edit-profile-form">
        <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" value="{{Auth::user()->name}}">
                <input type="file" name="avatar">
                <input type="submit" value="更新">
            </div>
        </form>
    </div>
@endsection
