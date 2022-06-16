@extends('layouts.logged_in')

@section('header')

@section('content')
<h1 class="title"><i class="fas fa-tshirt"></i>フォロワー 一覧</h1>

@forelse($followers as $user)
<div class="user_wrapper">
  <ul>
    <div class="icon_flex">
      <a href="{{ route('users.show',$user) }}">
        @if($user->user_image != '')
          <img src="{{ asset('storage/' . $user->user_image) }}" class="user_icon">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
        {{ $user->name }}
      </a>
    </div>
      <li>{{ $user->user_profile }}</li>
      <div class="user_flex">
        <li><i class="far fa-comment-alt"></i>投稿数：{{ $user->items->count() }}</li>
        <li><i class="far fa-handshake"></i>フォロー中：{{ $user->follow_users()->count() }}人</li>
        <li><i class="far fa-handshake"></i>フォロワー：{{ $user->followers()->count() }}人</li>
      </div>
  </ul>
</div>
@empty
フォローユーザーはいません。
@endforelse

@endsection