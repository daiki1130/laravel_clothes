@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>新規投稿</h1>
<form method="POST" action="{{ route('items.store') }}">
    @csrf
    <label>
        アイテム名：
        <input type="text" name="item_name">
    </label><br>
    <label>
        カテゴリー：<br>
    </label>
    <label>
        購入金額:<br>
    </label>
    <label>
        購入場所:<br>
    </label>
    <label>
        アイテム説明:<br>
        <textarea rows="10" name="item_description"></textarea>
    </label><br>
    <input type="submit" value="投稿">
</form>

@endsection