@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>投稿編集画面</h1>
<form method="POST" action="{{ route('posts.update',$post) }}">
    @csrf
    @method('patch')
    <label>
        投稿内容：<br>
        <textarea rows="10" name="post">{{ $post->post }}</textarea>
    </label><br>
    <input type="submit" value="更新">
</form>

@endsection