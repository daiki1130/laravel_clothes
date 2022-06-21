@extends('layouts.login_register')
 
@section('body')
<div class="container login_wrapper">
  <div class="row justify-content-center">
    <div class="col-3">
      <div class="d-flex justify-content-center">
        <h1>新規登録</h1>
      </div>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row justify-content-center">
          <div class="form-group">
            <label>
              ユーザー名：
              <input class="form-control" type="text" name="name">
            </label>
          </div>
          <div class="form-group">
            <label>
              メールアドレス：
              <input class="form-control" type="email" name="email">
            </label>
          </div>
          <div class="form-group">
            <label>
              パスワード：
              <input class="form-control" type="text" name="password">
            </label>
          </div>
          <div class="form-group">
            <label>
              パスワード（確認用）：
              <input class="form-control" type="text" name="password_confirmation">
            </label>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-9 text-right">
              <button type="submit" class="btn btn-primary">新規登録</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection