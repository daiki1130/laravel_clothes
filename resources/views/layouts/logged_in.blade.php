@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
      <div class="header_nav_left">
        <li>
          Daily Blog
        </li>
        <li>
          <a href="{{ route('top') }}">
            投稿一覧
          </a>
        </li>
      </div>
      <div class="header_nav_right">
        <li>
          <a href="{{ route('posts.create') }}">
            新規投稿
          </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
      </div>
    </ul>
</header>
@endsection