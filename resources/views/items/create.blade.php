@extends('layouts.logged_in')

@section('content')
<h1 class="title title_center"><i class="fas fa-tshirt"></i>新規投稿</h1>

<form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="mx-auto" style="max-width: 350px;">
    <div class="form-group form-inline">
      <label>
        <i class="fas fa-pen"></i> アイテム名：
        <input class="form-control" type="text" name="item_name">
      </label>
    </div>
    <div class="form-group form-inline">
      <label>
        <i class="fas fa-pen"></i> カテゴリー：
        <select class="form-control" name="category_id">
          <optgroup label="メンズ">
            @foreach ($men_categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
          </optgroup>
          <optgroup label="レディース">
            @foreach ($women_categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
          </optgroup>
        </select>
      </label>
    </div>
    <div class="form-group form-inline">
      <label>
        <i class="fas fa-pen"></i> 購入金額：
        <input class="form-control" type="text" name="item_price">
      </label>
    </div>
    <div class="form-group form-inline">
      <label>
        <i class="fas fa-pen"></i> 購入場所：
        <input class="form-control" type="text" name="item_place">
      </label>
    </div>
    <div class="form-group">
      <label>
        <i class="fas fa-pen"></i> アイテム説明：
        <textarea class="form-control" rows="5" cols="30" name="item_description"></textarea>
      </label>
    </div>
    <div class="form-group">
      <label>
        <i class="fas fa-pen"></i> アイテム画像：
        <input class="form-control-file" type="file" name="item_image">
      </label>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-9 text-right">
      <button type="submit" class="btn btn-primary">投稿</button>
    </div>
  </div>
</form>
@endsection