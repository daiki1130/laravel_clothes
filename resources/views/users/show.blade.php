@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>ユーザー詳細画面</h1>

<ul>
  <li>{{ $user->name }}</li>
  <li>
    @if($user->image != '')
      <img src="{{ asset('storage/' . $user->image) }}">
    @else
      <img src="{{ asset('images/no_image.png') }}">
    @endif
  </li>
  <li>
    <a href="{{ route('users.edit', $user) }}">編集</a>
  </li>
</ul>

<h2>投稿アイテム</h2>
<ul>
    @forelse($items as $item)
    <li>
      カテゴリー：{{ $item->category->name }}
    </li>
    <li>
      アイテム名：{{ $item->item_image }}
    </li>
    <li>
      購入金額：{{ $item->item_price }}
    </li>
    <li>
      購入場所：{{ $item->item_place }}
    </li>
    <li>
      商品説明：<br>
      {!! nl2br(e($item->item_description)) !!}
    </li>
    @if($item->image !== '')
      <img src="{{ asset('storage/' . $item->image) }}">
    @else
      <img src="{{ asset('images/no_image.png') }}">
    @endif
    <li>
      投稿日時：
      {{ $item->created_at }}
    </li>
    
    <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
    <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
      @csrf
      @method('patch')
    </form>
    
    @if (Auth::user()->id === $item->user_id)
    <li>
        <a href="{{ route('items.edit',$item) }}">編集</a>
    </li>
    <li>
        <form method="post" action="{{ route('items.destroy',$item) }}">
          @csrf
          @method('delete')
          <input type="submit" value="削除">
        </form>
    </li>
    @endif
    @empty
    <li>投稿はありません</li>
    @endforelse
</ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>
@endsection