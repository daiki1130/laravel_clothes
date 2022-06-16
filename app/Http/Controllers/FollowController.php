<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use App\User;
use App\Item;

class FollowController extends Controller
{
     // 自分がフォーローしている投稿一覧
    public function followIndex()
    {
        $follow_users = \Auth::user()->follow_users;
        return view('follows.follow_index', [
          'follow_users' => $follow_users,
        ]);
    }
    
    // フォローされているユーザーの一覧ページ
    public function followerIndex()
    {
        $followers = \Auth::user()->followers;
        return view('follows.follower_index', [
          'followers' => $followers,
        ]);
    }

    // フォローの追加処理
    public function store(Request $request)
    {
        $user = \Auth::user();
        Follow::create([
            'user_id' => $user->id,
            'follow_id' => $request->follow_id,
            ]);
        \Session::flash('success', 'フォローしました');
        return redirect()->route('top');
    }

    // フォローの削除処理
    public function destroy($id)
    {
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        \Session::flash('success', 'フォロー解除しました');
        return redirect()->route('top');
    }
    
    public function eachFollow()
    {
        $each_follows = \Auth::user()->follow_each();
        return view('follows.follow_each',[
            'title' => '相互フォロー一覧',
            'each_follows' => $each_follows,
            ]);
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }
}
