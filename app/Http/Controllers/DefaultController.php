<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Item;
use App\User;
use App\Like;
use App\Category;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
        $user = \Auth::user();
        $items = Item::orderBy('created_at','desc')->paginate(12);
        
        
        // 性別検索
        $category_gender = $request->input('category_gender');
        if(!empty($category_gender)){
        $items = Item::whereHas('Category', function ($query) use ($category_gender) {
            $query->where('category_gender',$category_gender);
        })->orderBy('created_at','desc')->paginate(12);
        }
        // カテゴリー検索
        $category_id = $request->input('id');
        if(!empty($category_id)){
        $items = Item::whereHas('Category', function ($query) use ($category_id) {
            $query->where('id',$category_id);
        })->orderBy('created_at','desc')->paginate(12);
        }
        
        // キーワード検索
        $keyword = $request->input('keyword');
        $query = Item::query();
        if(!empty($keyword))
        {
          $query->where('item_name','like', "%{$keyword}%")
                ->orWhere('item_place','like', "%{$keyword}%")
                ->orWhere('item_description','like', "%{$keyword}%");
           $items = $query->orderBy('created_at','desc')->paginate(12);
        }
        
        return view('items.index',[
            'user' => $user,
            'items' => $items,
            
            ]);
    }
    
    public function description()
    {
        return view('footers.site_info');
    }

}
