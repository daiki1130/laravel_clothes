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
          <a href="{{ route('register') }}" class="nav-link">サインアップ</a>
        </li>
        <li class="nav-item header_margin">
          <a href="{{ route('login') }}" class="nav-link">ログイン</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
@endsection