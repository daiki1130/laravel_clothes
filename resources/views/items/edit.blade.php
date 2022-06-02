@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>投稿編集画面</h1>
<form method="post" action="{{ route('items.update',$item) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <label>
        アイテム名：
        <input type="text" name="item_name" value={{ $item->item_name }}>
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
        <input type="text" name="item_price" value={{ $item->item_price }}>
    </label><br>
    <label>
        購入場所:
        <input type="text" name="item_place" value={{ $item->item_place }}>
    </label><br>
    <label>
        アイテム説明:<br>
        <textarea rows="10" name="item_description" value={{ $item->item_description }}></textarea>
    </label><br>
    <label>
        画像:
        @if($item->image !== '')
        <img src="{{ \Storage::url($item->image) }}">
        @else
        <img src="{{ asset('photos/no_image.png') }}">
        @endif
        <input type="file" name="item_image">
    </label>
    <input type="submit" value="更新">
</form>

@endsection