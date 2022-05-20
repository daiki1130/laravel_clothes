@extends('layouts.not_logged_in')
 
@section('content')
<div>
  <h1>ログイン</h1>
 
  <form method="POST" action="{{ route('login') }}">
      @csrf
      
      
      <div class="login_contents">
          <label>
            メールアドレス:<br>
            <input type="email" name="email">
          </label>
          <label><br>
            パスワード:<br>
            <input type="password" name="password" >
          </label><br>
 
      <input class="post_button" type="submit" value="ログイン">
      </div>
  </form>
</div>
@endsection