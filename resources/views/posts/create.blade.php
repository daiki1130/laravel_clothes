@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>新規投稿</h1>
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label>
        投稿内容<br>
        <textarea rows="10" name="post"></textarea>
    </label><br>
    <input type="submit" value="投稿">
</form>

@endsection