<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Auth;
use App\Item;
use App\User;
use App\Like;
use App\Category;

class ItemController extends Controller
{
    public function create()
    {
        $user = \Auth::user();
        $men_categories = Category::where('category_gender','men')->get();
        $women_categories = Category::where('category_gender','women')->get();
        
        return view('items.create',[
            'title' => '商品を出品',
            'user' => $user,
            'men_categories' => $men_categories,
            'women_categories' => $women_categories,
            ]);
    }

    public function store(ItemRequest $request)
    {
        $user = \Auth::user();
        $path = '';
        $item_image = $request->file('item_image');
        if(isset($item_image) === true){
            $path = $item_image->store('item_photos', 'public');
        }
        Item::create([
            'user_id' => Auth::user()->id,
            'item_name' => $request->item_name,
            'category_id'=> $request->category_id,
            'item_price' => $request->item_price,
            'item_place' => $request->item_place,
            'item_description' => $request->item_description,
            'item_image' => $path,
            ]);
            session()->flash('success','投稿しました。');
            return redirect()->route('users.show',$user);
    }

    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show',[
            'item' => $item,
            ]);
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $men_categories = Category::where('category_gender','men')->get();
        $women_categories = Category::where('category_gender','women')->get();
        return view('items.edit',[
            'item' => $item,
            'men_categories' => $men_categories,
            'women_categories' => $women_categories,
            ]);
    }

    public function update(ItemRequest $request, $id)
    {
        $user = \Auth::user();
        $item = Item::find($id);
        $item->update($request->only([
            'item_name',
            'category_id',
            'item_price',
            'item_place',
            'item_description',
            ]));
        
        // 画像更新
        $path = '';
        $image = $request->file('item_image');
 
        if( isset($image) === true ){
            $path = $image->store('item_photos', 'public');
        }
 
        $item = Item::find($id);
 
        if($item->item_image !== ''){
          \Storage::disk('public')->delete(\Storage::url($item->item_image));
        }
 
        $item->update([
          'item_image' => $path,
        ]);
        session()->flash('success', '投稿を編集しました');
        return redirect()->route('users.show',$user);
    }

    public function destroy($id)
    {
        $user = \Auth::user();
        $item = Item::find($id);
        $item->delete();
        session()->flash('success','投稿を消去しました。');
        return redirect()->route('users.show',$user);
    }

       public function __construct()
    {
        $this->middleware('auth');
    }
}
