<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\User;
use App\Item;

class UserController extends Controller
{
    
    public function show($id)
    {
        $user = User::find($id);
        $items = Item::where('user_id', $user->id) 
            ->orderBy('created_at', 'desc') 
            ->paginate(10);
        // 出品数カウント
        $item_count = Item::all()->where('user_id', $user->id)->count();
        // フォローカウント
        $follow_count = $user->follow_users()->count();
        //フォロワーカウント
        $follower_count = $user->followers()->count();
        return view('users.show',[
            'user' => $user,
            'items' => $items,
            'item_count' => $item_count,
            'follow_count' => $follow_count,
            'follower_count' => $follower_count,
            ]);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        return view('users.edit',[
            'title' => 'プロフィール編集',
            'user' => $user,
            ]);
    }

    public function update(UserEditRequest $request, $id)
    {
        $user = \Auth::user();
        $user->update($request->only([
            'name',
            'email',
            'user_profile',
            ]));
        
        // 画像更新
        $path = '';
        $image = $request->file('user_image');
        if(isset($image)===true){
            $path = $image->store('profiles','public');
        }
        
        $user = \Auth::user();
        if($user->user_image !==''){
            \Storage::disk('public')->delete(\Storage::url($user->user_image));
        }
        
        $user->update([
            'user_image' => $path,
            ]);
        
        session()->flash('success','更新しました。');
        return redirect()->route('users.show',$user);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
