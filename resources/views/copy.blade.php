@extends('layouts.login_register')
 
@section('body')
<div class="container login_wrapper">
  <div class="row justify-content-center">
    <div class="col-6">
      <div class="d-flex justify-content-center">
        <h1>新規投稿</h1>
      </div>
      <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
          <div class="form-group">
            <label>
              アイテム名：
              <input class="form-control" type="text" name="item_name">
            </label>
          </div>
          <div class="form-group">
            <label>
              カテゴリー：
              <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </label>
          </div>
          <div class="form-group">
            <label>
              購入金額：
              <input class="form-control" type="text" name="item_price">
            </label>
          </div>
          <div class="form-group">
            <label>
              購入場所：
              <input class="form-control" type="text" name="item_place">
            </label>
          </div>
          <div class="form-group">
            <label>
              アイテム説明：
              <textarea class="form-control" rows="10" name="item_description"></textarea>
            </label>
          </div>
          <div class="form-group">
            <label>
              アイテム画像：
              <input class="form-control" type="file" name="item_image">
            </label>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-9 text-right">
              <button type="submit" class="btn btn-primary">投稿</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

<ul class="header_nav">
        <li>
          <a href="{{ route('register') }}">
            サインアップ
          </a>
        </li>
        <li>
          <a href="{{ route('login') }}">
            ログイン
          </a>
        </li>
    </ul>
    
    
<div class="container">
  <div class="row">
    @forelse($items as $item)
    <div class="col-lg-4 col-sm-6 col-12 mt-3 mb-2">
      <div class="item card item">
        <div class="item_header ml-2 mr-2">
          @if($item->user->image != '')
            <img src="{{ asset('storage/' . $item->user->image) }}" class="img-fluid">
          @else
            <img src="{{ asset('images/no_image.png') }}" class="img-fluid">
          @endif
          {{ $item->user->name }}<br>
        </div>
        <div class="item_body ml-2 mr-2">
          <div class="item_body_img">
            <img src="{{ asset('storage/' . $item->item_image) }}" class="img-thumbnail" height="100">
          </div>
          <div class="item_body_name">
              アイテム名：{{ $item->item_name }}
          </div>
          <div class="item_body_price">
              購入金額: {{ $item->item_price }} 円
          </div>
        </div>
<!--いいね機能-->
        <div class="ml-2">
          @empty($login_user)
            ログイン後にいいねできます
          @else
            <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
            <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
              @csrf
              @method('patch')
            </form>
          @endempty
        </div>
      </div>
    </div>
      @empty
      投稿はありません
      @endforelse
  </div>
</div>

<h1 class="title title_center"><i class="fas fa-tshirt"></i>プロフィール編集</h1>

<form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <div class="mx-auto" style="max-width: 300px;">
    <div class="form-group form-inline">
      <label>
        名前：
        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
      </label>
    </div>
    <div class="form-group form-inline">
      <label>
        メールアドレス：
        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
      </label>
    </div>
    <div class="form-group form-inline">
      <label>
        プロフィール：
        <input class="form-control" type="text" name="user_profile" value="{{ $user->user_profile }}">
      </label>
    </div>
    <div class="form-group">
      <label>
        プロフィール画像：
        @if($user->image !== '')
          <img src="{{ \Storage::url($user->image) }}">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
        <input class="form-control-file" type="file" name="image">
      </label>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-9 text-right">
        <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </div>
</form>


<div class="dropdown drop-hover">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
    カテゴリー
  </button>
  <ul class="dropdown-menu">
    <li class="dropright drop-hover">
      <p class="dropdown-item dropdown-toggle" data-toggle="dropdown">メンズ</p>
      <ul class="dropdown-menu">
      <li class="dropright drop-hover">
      <select name="category_name">
        @foreach ($men_categories as $category)
          <option class="dropdown-item dropdown-toggle" value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
      </select>
      </li>
      </ul>
    </li>
  </ul>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <form method="get" action="{{ route('top') }}">
      <li class="nav-item">
        <a href="{{ route('top') }}">
              All
              <input class="nav-link" type="hidden" name="keyword">
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('top') }}">
              MEN
              <input class="nav-link" type="hidden" name="keyword">
            </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('top') }}">
              WEMEN
              <input class="nav-link" type="hidden" name="keyword">
            </a>
      </li>
      </form>
    </ul>
  </div>
</nav>

<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav">
        <form method="get" action="{{ route('top') }}">
        <li class="nav-item">
          <a href="{{ route('top') }}" class="nav-link">
            All
            <input type="hidden" name="keyword">
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('top') }}" class="nav-link">
            MEN
            <input type="hidden" name="keyword">
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('top') }}" class="nav-link">
            WEMEN
            <input type="hidden" name="keyword">
          </a>
        </li>
      </form>
      </ul>
    </div>
  </nav>
  
  <nav class="navbar navbar-expand-md navbar-light bg-light">
  
  <div class="justify-content-around" id="navbarNav4">
    <form method="get" action="{{ route('top') }}">
    <ul class="navbar-nav">
      <li class="nav-item">
                <a href="{{ route('top') }}" class="nav-item nav-link">
          All
          <input type="hidden" name="keyword">
        </a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ route('top') }}" class="nav-item nav-link">
          MEN
          <input type="hidden" name="keyword">
        </a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ route('top') }}" class="nav-item nav-link">
          WEMEN
          <input type="hidden" name="keyword">
        </a>
      </li>
    </ul>
    </form>
  </div>
</nav>

<div class="card">
  <div class="card-header">
    @if($item->user->user_image != '')
      <img src="{{ asset('storage/' . $item->user->user_image) }}" class="user_icon">
    @else
      <img src="{{ asset('images/no_image.png') }}">
    @endif
    {{ $item->user->name }}
  </div>
  <div class="card-body">
    <h5 class="card-title">アイテム名</h5>
    <p class="card-text">{{ $item->item_name }}</p>
    <h5 class="card-title">カテゴリー</h5>
    <p class="card-text">{{ $item->category->name }}</p>
    <h5 class="card-title">購入金額</h5>
    <p class="card-text">￥{{ $item->item_price }}</p>
    <h5 class="card-title">購入場所</h5>
    <p class="card-text">{{ $item->item_place }}</p>
    <h5 class="card-title">アイテム説明</h5>
    <p class="card-text">{{ $item->item_description }}</p>
    <div class="like_back hover">
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
    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="Your Good Buy | {{$item->item_name}}" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <div class="comment">
      @forelse($item->comments as $comment)
        ⚫︎{{ $comment->user->name }}: {{ $comment->comment_body }}
      @empty
        コメントはありません。
      @endforelse
      <form method="post" action="{{ route('comments.store',$item) }}">
        @csrf
      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <label>
        <input type="text" name="comment_body" placeholder="コメント" style="width:170px;">
      </label>
      <input type="submit" value="送信">
      </form>
    </div>
  </div>
</div>