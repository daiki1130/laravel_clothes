<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id','item_name','item_description','item_price','category_id','image',
        ];
}
