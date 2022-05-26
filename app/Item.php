<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id','item_name','item_description','item_price','item_place','item_image','category_id',
        ];
        
    public function user(){
      return $this->belongsTo('App\User');
    }
    
    public function category(){
      return $this->belongsTo('App\Category');
    }
    
    // いいね機能    
    public function likes(){
      return $this->hasMany('App\Like');
    }
 
    public function likedUsers(){
      return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikedBy($user){
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
}
