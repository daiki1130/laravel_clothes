@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>ユーザー詳細画面</h1>

<ul>
  <li>{{ $user->name }}</li>
</ul>

<h2>タイムライン</h2>
<ul>
    @forelse($items as $item)
    <li>
        投稿者名：{{ $item->user->name }}
    </li>
    <li>
        投稿内容：<br>
        {!! nl2br(e($item->post)) !!}
    </li>
    <li>
        投稿日時：
        {{ $item->created_at }}
    </li>
    @if (Auth::user()->id === $item->user_id)
    <li>
        <a href="{{ route('posts.edit',$item) }}">編集</a>
    </li>
    <li>
        <form method="post" action="{{ route('posts.destroy',$item) }}">
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
@endsection