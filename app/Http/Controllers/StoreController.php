<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\Categorie;
use Hash;
use App\Product;
use Illuminate\Contracts\Auth\Authenticatable;
class StoreController extends Controller
{
        public function registerStore(Request $request)
    {
        
            $user=new User();
         if ($request->isMethod('post')) {
               $parametre = $request->except(['_token']);
           $user->name = $parametre['name'];
           $user->email = $parametre['email'];     
           $user->password  = Hash::make($parametre['password']);
           $user->role='seller';  
           $user->save();
            Auth::login($user);
            return redirect()->route('profile');
           }
              
}

  public function contact(){
         
      return view('contact');          
}
public function welcome(){
         $cats = Categorie::all();
            $men = Categorie::where('name', '=', 'men')->first()->products->take(8);
            $women = Categorie::where('name', '=', 'women')->first()->products->take(8);
            $sport = Categorie::where('name', '=', 'sports')->first()->products->take(8);
            $electronic = Categorie::where('name', '=', 'electronics')->first()->products->take(8);

            $data = array('men'=>$men, 'women'=>$women , 'sport'=>$sport , 'electronic'=>$electronic);

    return view('welcome')->with('cats',$cats)->with($data);
              
}

public function search(Request $request)
    {
       if ($request->isMethod('post')) {
      $parametre = $request->except(['_token']);
  $products = Product::where('descreption', 'RLIKE', $parametre['index'])->orwhere('name', 'RLIKE', $parametre['index'])->paginate(6);
           }
      $cats = Categorie::all();
      return view('product')->with('products',$products)->with('cats',$cats);
    }

}
