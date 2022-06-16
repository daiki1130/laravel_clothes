@extends('layouts.logged_in')
 
 
@section('content')
<h1 class="title title_center"><i class="fas fa-tshirt"></i>プロフィール編集</h1>

<form method="post" action="{{ route('users.update',$user) }}" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <div class="mx-auto" style="max-width: 350px;">
    <div class="form-group form-inline">
      <label>
        <i class="fas fa-pen"></i> 名前：
        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
      </label>
    </div>
    <div class="form-group form-inline">
      <label>
        <i class="fas fa-pen"></i> メールアドレス：
        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
      </label>
    </div>
    <div class="form-group">
      <label>
        <i class="fas fa-pen"></i> プロフィール：
        <textarea class="form-control" rows="5" cols="30" name="user_profile">{{ $user->user_profile }}</textarea>
      </label>
    </div>
    <div class="form-group">
      <label>
        <i class="fas fa-pen"></i> プロフィール画像：
        @if($user->user_image !== '')
          <img src="{{ \Storage::url($user->user_image) }}" class="user_icon">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
        <input class="form-control-file" type="file" name="user_image">
      </label>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-9 text-right">
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </div>
</form>
@endsection
