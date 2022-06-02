<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta name="viewport" content="initial-scale=1">
</head>
<body>
    @yield('header')
 
    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
      <p class="error">{{ $error }}</p>
    @endforeach
 
    {{-- 成功メッセージを出力 --}}
    @if (session()->has('success'))
        <div class="success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-2 side_left">
                <ul>
                    @empty($login_user)
                        <li>ログインしてください</li>
                    @else
                        <li>
                        @if($login_user->image != '')
                            <img src="{{ asset('storage/' . $login_user->image) }}">
                        @else
                            <img src="{{ asset('images/no_image.png') }}">
                        @endif
                        </li>
                        <li>{{ $login_user->name }}</li>
                        <li>
                            <a href="{{ route('users.edit', $login_user) }}">編集</a>
                        </li>
                    @endempty
                </ul>
            </div>
            <div class="col-12 col-sm-8">@yield('content')</div>
            <div class="col-12 col-sm-2 side_right">
                <h2>おすすめユーザー</h2>
                <ul class="recommended_users">
                    @forelse($recommended_users as $recommended_user)
                      <li>
                        <a href="{{ route('users.show', $recommended_user) }}">{{ $recommended_user->name }}</a>
                        @empty($login_user)
                            <li>ログイン後にフォローできます</li>
                        @else
                            @if(Auth::user()->isFollowing($recommended_user))
                              <form method="post" action="{{route('follows.destroy', $recommended_user)}}" class="follow">
                                @csrf
                                @method('delete')
                                <input type="submit" value="フォロー解除">
                              </form>
                            @else
                              <form method="post" action="{{route('follows.store')}}" class="follow">
                                @csrf
                                <input type="hidden" name="follow_id" value="{{ $recommended_user->id }}">
                                <input type="submit" value="フォロー">
                              </form>
                            @endif
                        @endempty
                      </li>
                      @empty
                      <li>おすすめユーザーはいません。</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>