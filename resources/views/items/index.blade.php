@extends(($login_user == '')?'layouts.not_logged_in':'layouts.logged_in')

@section('header')

@section('content')
<h1>トップページ</h1>

<form action="{{ route('top') }}" method="GET">
    <input type="text" placeholder="キーワードを入力" name="keyword" >
    <input type="submit" value="検索">
</form>
  
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
<!--いいね機能-->
    @empty($login_user)
      <li>ログイン後にいいねできます</li>
    @else
      <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
      <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
        @csrf
        @method('patch')
      </form>
    @endempty
<!--投稿編集-->
    @empty($login_user)
    <li></li>
    @else
      @if(Auth::user()->id === $item->user_id)
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
    @endempty
<!--コメント機能-->
    <ul>
      @forelse($item->comments as $comment)
        <li>{{ $comment->user->name }}: {{ $comment->body }}</li>
      @empty
        <li>コメントはありません。</li>
      @endforelse
    </ul>
    <form method="post" action="{{ route('comments.store',$item) }}">
      @csrf
      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <label>
        <input type="text" name="comment_body">
      </label>
      <input type="submit" value="送信">
    </form>
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