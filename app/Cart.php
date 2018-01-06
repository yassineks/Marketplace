<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table ='cart';
     public function checkout()
    {
        return $this->belongsTo('App\Checkout');
    }
}
