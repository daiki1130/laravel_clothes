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
    public function index()
    {
        $user = \Auth::user();
        $items = Item::all();
        return view('items.index',[
            'user' => $user,
            'items' => $items,
            ]);
    }
}
