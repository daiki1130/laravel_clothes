<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use App\Item;

class CommentController extends Controller
{
   public function store(CommentRequest $request, $id)
   {
        $item = Item::find($id);
        Comment::create([
            'item_id'   => $request->item_id,
            'user_id' => \Auth::user()->id,
            'comment_body' => $request->comment_body,
        ]);
        session()->flash('success', 'コメントを投稿しました');
        return redirect()->route('items.show',$item);
    }
}