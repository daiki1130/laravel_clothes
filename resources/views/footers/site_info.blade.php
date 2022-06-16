@extends(($login_user == '')?'layouts.not_logged_in':'layouts.logged_in')
 
@section('body')
<div class="container site_info">
  <div class="row justify-content-center">
    <div class="col-8">
      <h2 class="title"><i class="fas fa-tshirt"></i>サイトについて</h2>
        <p>当サイトにお越しいただきありがとうございます。</p>
        <p>当サイトは、あなたが購入した最高の服たち(Your Good Clothes)を掲載して頂くサイトです。</p>
        <p>アパレルショップ、古着屋、リサイクルショップ、フリーマーケット、フリマサイトなどなど<br>
           これめっちゃ安く買えた！！みんな見て！！という自己満足全開にして自慢しまくってください！！
        </p>
        <p>
            将来的に、もっと「古着市場」が賑わったら良いなという思いで、サイト運営をさせて頂きます。
        </p>
        
        <h2 class="title"><i class="fas fa-tshirt"></i>サイトの使い方</h2>
        <h3><i class="far fa-check-circle"></i>ログイン前</h3>
        <p>投稿一覧内での閲覧のみ（カテゴリー検索は可能）</p>
        <h3><i class="far fa-check-circle"></i>ログイン後</h3>
        <p>アイテムのより詳細な情報閲覧、投稿のお気に入り機能、コメント機能、フォロー機能などがございます。<br>
           ぜひログインしていただき、当サイトをご利用くださいませ。
        </p>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-2">
        <button class="list-group-item list-group-item-action link">
          <a href="{{ route('register') }}">
          新規登録画面
          </a>
        </button>
        <button class="list-group-item list-group-item-action link mt-2">
          <a href="{{ route('login') }}">
          ログイン画面
          </a>
        </button> 
    </div>
  </div>
</div>
@endsection