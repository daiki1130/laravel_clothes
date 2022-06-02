<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $categories = Category::all();
        return view('items.create',[
            'title' => '商品を出品',
            'user' => $user,
            'categories' => $categories,
            ]);
    }

    public function store(Request $request)
    {
        $path = '';
        $item_image = $request->file('item_image');
        if(isset($item_image) === true){
            $path = $image->store('item_photos', 'public');
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
            return redirect()->route('top');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit',[
            'item' => $item,
            ]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->only([
            'item_name',
            'category_id',
            'item_price',
            'item_place',
            'item_description',
            ]));
            
        $path = '';
        $image = $request->file('image');
 
        if( isset($image) === true ){
            $path = $image->store('item_photos', 'public');
        }
 
        $item = Item::find($id);
 
        if($item->image !== ''){
          \Storage::disk('public')->delete(\Storage::url($item->image));
        }
 
        $post->update([
          'image' => $path,
        ]);
        session()->flash('success', '投稿を編集しました');
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        //
    }

       public function __construct()
    {
        $this->middleware('auth');
    }
}
