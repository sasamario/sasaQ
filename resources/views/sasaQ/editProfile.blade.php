@extends('layouts.app')

@include('layouts.error')

@section('content')
    <div class="top-wrapper">
        <div class="edit-profile-form">
            <p>プロフィール編集フォーム</p>
            <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <lavel>名前（必須）</lavel>
                    <input type="text" class="profile-form-box" name="name" value="{{Auth::user()->name}}">
                </div>
                <div id="app" class="form-group profile-form-box">
                    <lavel>プロフィール画像選択</lavel>
                    <profile-image-preview-component></profile-image-preview-component>
                </div>
                <div class="profile-form-submit">
                    <input type="submit" value="更新">
                </div>
            </form>
        </div>
    </div>
@endsection
