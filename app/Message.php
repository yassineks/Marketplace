<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
      public function buyer()
    {
        return $this->belongsTo('App\User','buyer_id');
    }
      public function seller()
    {
        return $this->belongsTo('App\User','seller_id');
    }
}
