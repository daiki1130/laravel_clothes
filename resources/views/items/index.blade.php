@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>トップページ</h1>

<form action="{{ route('top') }}" method="GET">
    <input type="text" placeholder="キーワードを入力" name="keyword" >
    <input type="submit" value="検索">
</form>

<h2>おすすめユーザー</h2>
<ul class="recommended_users">
    @forelse($recommended_users as $recommended_user)
      <li>
        <a href="{{ route('users.show', $recommended_user) }}">{{ $recommended_user->name }}</a>
        @if(Auth::user()->isFollowing($recommended_user))
          <form method="post" action="{{route('follows.destroy', $recommended_user)}}" class="follow">
            @csrf
            @method('delete')
            <input type="submit" value="フォロー解除">
          </form>
        @else
          <form method="post" action="{{route('follows.store')}}" class="follow">
            @csrf
            <input type="hidden" name="follow_id" value="{{ $recommended_user->id }}">
            <input type="submit" value="フォロー">
          </form>
        @endif
      </li>
      @empty
      <li>おすすめユーザーはいません。</li>
    @endforelse
</ul>
  
<h2>タイムライン</h2>
<ul>
    @forelse($items as $item)
    <li>
      投稿者名：{{ $item->user->name }}
    </li>
    <li>
      カテゴリー：{{ $item->category->name }}
    </li>
    <li>
      アイテム名：{{ $item->item_name }}
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