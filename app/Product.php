<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

      public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function buyer()
    {
        return $this->belongsToMany('App\User', 'cart', 'user_id', 'product_id')->withPivot('checkout_id');;
    }

    public function wichlists()
    {
        return $this->belongsToMany('App\Wichlist', 'wichlist_product', 'wichlist_id', 'product_id');
    }
}
