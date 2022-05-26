<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('users.show',[
            'user' => $user,
            'items' => $items,
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

    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $user->update($request->only([
            'name',
            'email',
            'user_profile',
            ]));
        
        $path = '';
        $image = $request->file('image');
        if(isset($image)===true){
            $path = $image->store('profiles','public');
        }
        
        $user = \Auth::user();
        if($user->image !==''){
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        
        $user->update([
            'image' => $path,
            ]);
        
        session()->flash('success','更新しました。');
        return redirect()->route('users.show',$user);
    }

    public function destroy($id)
    {
        //
    }
}
