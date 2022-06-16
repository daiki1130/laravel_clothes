@extends('layouts.logged_in')

@section('header')

@section('content')
<h1 class="title"><i class="fas fa-tshirt"></i>お気に入り一覧</h1>

<div class="container">
  <div class="row">
    @forelse($like_items as $item)
    <div class="card-group col-lg-4 col-sm-6 col-12 mt-3 mb-2">
        <div class="card">
          <img class="card-img-top" src="{{ asset('storage/' . $item->item_image) }}" height="200">
          <div class="card-img-overlay">
            <div class="price_back">
              ￥{{ $item->item_price }}
            </div>
            <div class="like_back hover">
              @empty($login_user)
              
              @else
              <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
              <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                @csrf
                @method('patch')
              </form>
              @endempty
            </div>
          </div>
          <div class="card-body pt-1 pb-1 px-2">
            <div class="card-text">
              <div class="float-left list-group user_link">
                <a href="{{ route('users.show',$item->user) }}" class="list-group-item list-group-item-action">
                @if($item->user->user_image != '')
                  <img src="{{ asset('storage/' . $item->user->user_image) }}" class="user_icon">
                @else
                  <img src="{{ asset('images/no_image.png') }}" class="img-fluid">
                @endif
                {{ $item->user->name }}
                </a>
              </div>
              <div class="float-right  list-group item_info">
                <a class="list-group-item list-group-item-action" href="{{ route('items.show',$item) }}">詳細</a>
                <div class="float-right like_comment_margin">
                  <i class="far fa-star"></i>{{ $item->likedUsers()->count() }}
                  <i class="far fa-comment"></i>{{ $item->comments()->count() }}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
      @empty
      投稿はありません
      @endforelse
  </div>
</div>   
@endsection