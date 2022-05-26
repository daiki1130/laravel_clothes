@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <form method="post" action="{{ route('users.update',$user)}}"　enctype="multipart/form-data">
        @csrf
        @method('patch')
        <a href="{{route('users.show',$user)}}">戻る</a>
        <label>
            名前:
            <input type="text" name="name" value="{{ $user->name }}">
        </label><br>
        <label>
            メールアドレス:
            <input type="text" name="email" value="{{ $user->email }}">
        </label><br>
        <label>
            プロフィール:<br>
            <textarea name="user_profile" rows="10"> {{ $user->user_profile }}</textarea>
        </label><br>
        <label>
            プロフィール画像：<br>
            @if($user->image !== '')
                <img src="{{ \Storage::url($user->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif
            画像を選択：
　          <input type="file" name="image">
        </label>
        <input type="submit" value="更新">
    </form>
@endsection