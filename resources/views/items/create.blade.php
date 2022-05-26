@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>新規投稿</h1>
<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
    @csrf
    <label>
        アイテム名：
        <input type="text" name="item_name">
    </label><br>
    <label>
        カテゴリー：
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </label><br>
    <label>
        購入金額:
        <input type="text" name="item_price">
    </label><br>
    <label>
        購入場所:
        <input type="text" name="item_place">
    </label><br>
    <label>
        アイテム説明:<br>
        <textarea rows="10" name="item_description"></textarea>
    </label><br>
    <label>
        画像:
        <input type="file" name="item_image">
    </label>
    
    <input type="submit" value="投稿">
</form>

@endsection