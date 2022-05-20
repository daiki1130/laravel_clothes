@extends('layouts.not_logged_in')
 
@section('content')
<div>
  <h1>ユーザー登録</h1>
 
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="register_contents">
      <label>
        ユーザー名:<br>
        <input type="text" name="name">
      </label><br>
      <label>
        メールアドレス:<br>
        <input type="email" name="email">
      </label><br>
      <label>
        パスワード:<br>
        <input type="password" name="password">
      </label><br>
      <label>
        パスワード（確認用）:<br>
        <input type="password" name="password_confirmation" >
      </label><br>
      <input class="post_button" type="submit" value="登録">
    </div>
  </form>
</div>
@endsection