<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function products()
    {
        return $this->hasMany('App\Product');
    }
    
     public function categories()
    {
        return $this->belongsToMany('App\Categorie');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
 public function purchases()
    {
        return $this->belongsToMany('App\Product', 'cart', 'user_id', 'product_id')->wherePivot('checkout_id', null);

    }

     public function checkouts()
    {
        return $this->hasMany('App\Checkout');
    }

     public function msgs()
    {
        return $this->hasMany('App\Message');
    }

     public function whichlist()
    {
        return $this->hasOne('App\Wichlist');
    }
}
