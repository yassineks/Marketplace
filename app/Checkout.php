<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
public function carts()
    {
        return $this->hasMany('App\Cart');
    }


public function owner()
    {
        return $this->belongsTo('App\User');
    }
}
