@extends('layouts.logged_in')

@section('header')

@section('content')
<h1>トップページ</h1>

<form action="{{ route('top') }}" method="GET">
    <input type="text" placeholder="キーワードを入力" name="keyword" value={{$keyword}}>
    <input type="submit" value="検索">
</form>

<h2>おすすめユーザー</h2>
<ul>
    @forelse($recommend_users as $recommend_user)
      <li>
        <a href="{{ route('users.show', $recommend_user) }}">{{ $recommend_user->name }}</a></li>
        @if(Auth::user()->isFollowing($recommend_user))
            <form method="post" action="{{ route('follows.destroy',$recommend_user) }}">
                @csrf
                @method('delete')
                <input type="submit" value="フォロー解除">
            </form>
        @else
            <form method="post" action="{{ route('follows.store',$recommend_user) }}">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $recommend_user->id }}">
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
    @forelse($posts as $post)
    <li>
        投稿者名：{{ $post->user->name }}
    </li>
    <li>
        投稿内容：<br>
        {!! nl2br(e($post->post)) !!}
    </li>
    <li>
        投稿日時：
        {{ $post->created_at }}
    </li>
    @if (Auth::user()->id === $post->user_id)
    <li>
        <a href="{{ route('posts.edit',$post) }}">編集</a>
    </li>
    <li>
        <form method="post" action="{{ route('posts.destroy',$post) }}">
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