<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wichlist extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product', 'wichlist_product', 'wichlist_id', 'product_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
