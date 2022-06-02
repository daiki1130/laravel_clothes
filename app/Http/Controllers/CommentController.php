<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
   public function store(Request $request){
        Comment::create([
            'item_id'   => $request->item_id,
            'user_id' => \Auth::user()->id,
            'comment_body' => $request->comment_body,
        ]);
        session()->flash('success', 'コメントを投稿しました');
        return redirect('/');
    }
}