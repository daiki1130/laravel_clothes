<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;

class ItemController extends Controller
{

    public function index()
    {
        $user = \Auth::user();
        $items = Item::all();
        return view('items.index',[
            'user' => $user,
            'items' => $items,
            'recommended_users' => User::recommend($user->id)->get()
            ]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        Item::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
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
        //
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
