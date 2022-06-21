@extends('layouts.default')
 
@section('header')
<header>
  <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
    <a href="{{ route('top') }}"  class="navbar-brand">Your Good Clothes</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item header_margin">
          <a href="{{ route('description') }}" class="nav-link">当サイトについて</a>
        </li>
        <li class="nav-item header_margin">
          <a href="{{ route('top') }}" class="nav-link">投稿一覧</a>
        </li>
        <li class="nav-item header_margin">
          <a href="{{ route('items.create') }}" class="nav-link">新規投稿</a>
        </li>
        <li class="nav-item header_margin">
          <a href="{{ route('users.show', Auth::user()) }}" class="nav-link">マイページ</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" class="nav-link">
              @csrf
              <input type="submit" value="ログアウト">
          </form>
        </li>
      </ul>
    </div>
  </nav>
</header>
@endsection

@section('body')
<div class="container-fluid">
  <div class="row">
<!--左メニュー-->
    <div class="col-12 col-sm-2 side_left">
<!--カテゴリー-->
      <div class="categories_wrapper">
        <h2><i class="fas fa-tshirt"></i>カテゴリー</h2>
        <div class="categories">
          <div class="card-header">
            <h3><i class="fas fa-male"></i>メンズ</h3>
          </div>
            <div class="list-group">
              @foreach($men_categories as $men_category)
              <form method="get" action="{{ route('top') }}">
                <a href="{{ route('top') }}">
                  <button class="category_list list-group-item list-group-item-action" type="submit" name="id" value="{{ $men_category->id }}">
                    <i class="far fa-arrow-alt-circle-right"></i>{{ $men_category->category_name }}
                  </button>
                </a>
              </form>
              @endforeach
            </div>
        </div>
        <div class="categories">
          <div class="card-header">
            <h3><i class="fas fa-female"></i>レディース</h3>
          </div>
            <div class="list-group">
              @foreach($women_categories as $women_category)
              <form method="get" action="{{ route('top') }}">
                <button class="category_list list-group-item list-group-item-action" type="submit" name="id" value="{{ $women_category->id }}">
                  <a href="{{ route('top') }}">
                  <i class="far fa-arrow-alt-circle-right"></i>{{ $women_category->category_name }}
                  </a>
                </button>
              </form>
              @endforeach
            </div>
        </div>
      </div>
    </div>
<!--メインコンテンツ-->
    <div class="col-12 col-sm-8 content">
    @yield('content')
    </div>
<!--右メニュー-->
    <div class="col-12 col-sm-2 side_right">
<!--ログインユーザー-->
      <div class="user_info">
        <div class="card-header">
          @if($login_user->user_image != '')
              <img src="{{ asset('storage/' . $login_user->user_image) }}" class="user_icon">
          @else
              <img src="{{ asset('images/no_image.png') }}">
          @endif
          {{ $login_user->name }}<br>
          <div class="list-group user_info_link">
            <a href="{{ route('users.show', $login_user) }}" class="list-group-item list-group-item-action">マイページ</a>
          </div>
          <div class="list-group user_info_edit">
            <a href="{{ route('users.edit', $login_user) }}" class="list-group-item list-group-item-action">編集</a>
          </div>
        </div>
        <div class="list-group user_info_list">
          <a href="{{ route('likes.index') }}" class="list-group-item list-group-item-action"><i class="far fa-star"></i>お気に入り投稿</a>
          <a href="{{ route('follows.index') }}" class="list-group-item list-group-item-action"><i class="far fa-handshake"></i>フォロー</a>
          <a href="{{ route('followers.index') }}" class="list-group-item list-group-item-action"><i class="far fa-handshake"></i>フォロワー</a>
        </div>
      </div>
<!--おすすめユーザー-->
      <div class="recommended_users">
        <h2><i class="fas fa-tshirt"></i>おすすめユーザー</h2>
        <ul class="list-group">
          @forelse($recommended_users as $recommended_user)
            <li class="list-group-item follow_wrapper">
              <a href="{{ route('users.show', $recommended_user) }}">
                @if($recommended_user->user_image != '')
                  <img src="{{ asset('storage/' . $recommended_user->user_image) }}" class="user_icon">
                @else
                  <img src="{{ asset('images/no_image.png') }}">
                @endif
                {{ $recommended_user->name }}
              </a>
              @empty($login_user)
                <li>ログイン後にフォローできます</li>
              @else
                @if(Auth::user()->isFollowing($recommended_user))
                  <form method="post" action="{{route('follows.destroy', $recommended_user)}}" class="follow list-group-item list-group-item-action">
                    @csrf
                    @method('delete')
                    <i class="far fa-handshake"></i><input type="submit" value="フォロー解除">
                  </form>
                @else
                  <form method="post" action="{{route('follows.store',$recommended_user)}}" class="follow list-group-item list-group-item-action">
                    @csrf
                    <input type="hidden" name="follow_id" value="{{ $recommended_user->id }}">
                    <i class="far fa-handshake"></i><input type="submit" value="フォロー">
                  </form>
                @endif
              @endempty
              @empty
              <p>おすすめユーザーはいません。</p>
            </li>
          @endforelse
        </ul> 
      </div>
    </div>
  </div>
</div>
@endsection