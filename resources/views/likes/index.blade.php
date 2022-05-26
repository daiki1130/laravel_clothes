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
        <li>商品名：{{ $item->name }} {{ $item->price }}</li>
        <li>カテゴリ：{{ $item->category->name }} {{ $item->updated_at }}</li>
        
        @if($item->isPurchasedItems($item))
        <li>売り切れ</li>
        @else
        <li>出品中</li>
        @endif
    </div>
    @empty
    <li>商品はありません。</li>
    @endforelse
</ul>
@endsection