@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>お気に入り一覧</h1>
<ul>
    @forelse($like_items as $item)
    <div class="item_list_top">
        <li>
            <a href="{{ route('items.show',$item) }}">
                @if($item->image != '')
                <img src="{{ asset('storage/' . $item->image) }}">
                @else
                <img src="{{ asset('images/no_image.png') }}">
                @endif
            </a>
        </li>
        <li>{{ $item->description }} </li>
        <li>アイテム名：{{ $item->name }} {{ $item->price }}</li>
        <li>カテゴリ：{{ $item->category->name }} {{ $item->updated_at }}</li>
        
    </div>
    @empty
    <li>アイテムはありません。</li>
    @endforelse
</ul>
@endsection