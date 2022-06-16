@extends('layouts.login_register')
 
@section('body')
<div class="container login_wrapper">
  <div class="row justify-content-center">
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <h1>ログイン</h1>
      </div>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row justify-content-center">
          <div class="form-group">
            <label>
              メールアドレス：
              <input class="form-control" type="email" name="email">
            </label>
          </div>
          <div class="form-group">
            <label>
              パスワード：
              <input class="form-control" type="password" name="password">
            </label>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-9 text-right">
            <button type="submit" class="btn btn-primary">ログイン</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection