@extends('layouts.logged_in')

@section('content')
<h1 class="title"><i class="fas fa-tshirt"></i>アイテム詳細</h1>

<div class="container">
  <div class="row">
    <div class="col-12 col-sm-6">
<!--アイテム画像-->
      <div class="item_body_img">
        <img src="{{ asset('storage/' . $item->item_image) }}" class="img-thumbnail" height="100">
      </div>
<!--コメント送信-->
      <div class="card comment_wrapper">
        <div class="card-header comment">
          <form method="post" action="{{ route('comments.store',$item) }}">
            @csrf
          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <label>
            <i class="far fa-comment"></i> <input type="text" name="comment_body" placeholder="コメント" style="width:170px;">
          </label>
          <input type="submit" value="送信">
          </form>
        </div>
<!--コメント一覧-->
        <div class="card-body">
          @forelse($item->comments as $comment)
            <div class="card-text comment">
          @if($comment->user->user_image != '')
            <img src="{{ asset('storage/' . $comment->user->user_image) }}" class="user_icon">
          @else
            <img src="{{ asset('images/no_image.png') }}">
          @endif
            {{ $comment->user->name }}: {{ $comment->comment_body }}<br> {{$comment->created_at }}
          </div>
          @empty
          
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6">
<!--アイテム説明-->
      <div class="card">
        <div class="card-header user_link">
          <a href="{{ route('users.show',$item->user) }}">
            @if($item->user->user_image != '')
              <img src="{{ asset('storage/' . $item->user->user_image) }}" class="user_icon">
            @else
              <img src="{{ asset('images/no_image.png') }}">
            @endif
            {{ $item->user->name }}
          </a>
        </div>
        <div class="card-body item_body">
          <h5 class="card-title"><i class="fas fa-barcode"></i> アイテム名</h5>
          <p class="card-text">{{ $item->item_name }}</p>
          <h5 class="card-title"><i class="fas fa-barcode"></i> カテゴリー</h5>
          <p class="card-text">{{ $item->category->category_name }}</p>
          <h5 class="card-title"><i class="fas fa-barcode"></i> 購入金額</h5>
          <p class="card-text">￥{{ $item->item_price }}</p>
          <h5 class="card-title"><i class="fas fa-barcode"></i> 購入場所</h5>
          <p class="card-text">{{ $item->item_place }}</p>
          <h5 class="card-title"><i class="fas fa-barcode"></i> アイテム説明</h5>
          <p class="card-text">{{ $item->item_description }}</p>
          <h5 class="card-title"><i class="fas fa-barcode"></i> 投稿日時</h5>
          <p class="card-text">{{ $item->created_at }}</p>
          <div>
            @empty($login_user)
             ログイン後にいいねできます。
            @else
            <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
            <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
              @csrf
              @method('patch')
            </form>
            @endempty
          </div>
<!--ツイッター   -->
          <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="Your Good Buy | {{$item->item_name}}" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script><br>
<!--編集と削除-->
          @if (Auth::user()->id === $item->user->id)
          <div class="d-flex">
            <button class="edit_button">
              <a href="{{ route('items.edit',$item) }}" class="btn btn-primary">編集</a>
            </button>
            <form class="mt-1 ml-1" method="post" action="{{ route('items.destroy', $item) }}">
              @csrf
              @method('DELETE')
              <button class="btn btn-primary">
              <input type="submit" value="削除">
              </button>
            </form>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>
@endsection