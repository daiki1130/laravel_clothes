<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/destyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta name="viewport" content="initial-scale=1">
</head>

<body class="wrapper">
<!--ヘッダー-->
  @yield('header')
<!--カルーセル-->
  <div id="cl" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#cl" data-slide-to="0" class="active"></li>
        <li data-target="#cl" data-slide-to="1"></li>
        <li data-target="#cl" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/header_back1.jpg') }}" class="d-block w-100 h-100">
      </div>
      <div class="carousel-caption">
        <h1>Your Good Clothes</h1>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/header_back3.jpg') }}" class="d-block mx-auto w-100 h-100">
      </div>
      <div class="carousel-caption">
        <h1>Your Good Clothes</h1>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/header_back4.jpg') }}" class="d-block mx-auto w-100 h-100">
      </div>
      <div class="carousel-caption">
        <h1>Your Good Clothes</h1>
      </div>
    </div>
    <a class="carousel-control-prev" href="#cl" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#cl" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  
<!--サブメニュー-->
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="collapse navbar-collapse justify-content-around" id="navbarNav4">
      <ul class="navbar-nav">
        <form method="get" action="{{ route('top') }}">
          <li class="nav-item">
            <a href="{{ route('top') }}" class="nav-item nav-link">
              All
            </a>
          </li>
        </form>
      </ul>
      <ul class="navbar-nav">
        <form method="get" action="{{ route('top') }}">
          <li class="nav-item">
            <a href="{{ route('top') }}" class="nav-item nav-link">
              <button type="submit" name="category_gender" value="men">MEN</button>
            </a>
          </li>
        </form>
      </ul>
      <ul class="navbar-nav">
        <form method="get" action="{{ route('top') }}">
          <li class="nav-item">
            <a href="{{ route('top') }}" class="nav-item nav-link">
              <button type="submit" name="category_gender" value="women">WOMEN</button>
            </a>
          </li>
        </form>
      </ul>
    </div>
  </nav>
  
    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
      <p class="alert alert-danger error">{{ $error }}</p>
    @endforeach
 
    {{-- 成功メッセージを出力 --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

<!--メインコンテンツ-->
    @yield('body')
    
<!--フッター-->
    <footer>
        <ul>
          <li class="nav-item header_margin footer">
            <a href="{{ route('description') }}" class="nav-link">当サイトについて</a>
          </li>
          <li>©︎DAIKI INOHARA</li>
        </ul>
    </footer>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
<script>
  function clickBtn() {
    const a = document.getElementById("category_gender").value;
  }
</script>
</body>
</html>