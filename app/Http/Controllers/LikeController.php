<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Item;
use App\User;
use App\Category;

class LikeController extends Controller
{
    public function index(){
        $like_items = \Auth::user()->likedItems()->get();
        return view('likes.index',[
            'like_items' => $like_items,
            ]);
    }
    
    public function toggleLike($id)
    {
        $user = \Auth::user();
        $item = Item::find($id);
 
        if($item->isLikedBy($user)){
            // いいねの取り消し
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'いいねを取り消しました');
        } else {
            // いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'いいねしました');
        }
        return redirect()->route('top');
      }
}