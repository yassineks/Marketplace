<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
class Sellerkhh
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    


         if(Auth::guard($guard)->user()->role=='seller'){
                return $next($request);
          
            }else{
                return redirect()->guest('login');
            }
           
        }

      

}
