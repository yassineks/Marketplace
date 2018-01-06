<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Categorie;
use App\Product;
use Auth;
use App\Cart;
use App\comment;
use App\Message;
use App\Checkout;
use App\Wichlist;
use Hash;
use PDF;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {    
        return view('home');
    }
    */
     public function profile()
    {
             $cats = Categorie::all();

        return view('profile')->with('cats',$cats);
    }
    
         public function updateprofileinfos(Request $request)
    {
           $user =User::where('id', '=', auth::user()->id)->first();
           $parametre = $request->except(['_token']);
           $user->name  = $parametre['name'];     
           $user->sexe = $parametre['gender'];     
           $user->birthday  = $parametre['birthday'];     
           $user->save();
                return redirect()->route('profile');                   
   }
    
      public function store()
    {     
          $categories=Categorie::all();
      return view('store')->with('categories',$categories); 
    }

       public function updateprofile(Request $request)
    {
           $user =User::where('id', '=', auth::user()->id)->first();
           $parametre = $request->except(['_token']);
           $user->email = $parametre['user_email'];     
           $user->password  = Hash::make($parametre['password']);
           $user->save();
                return redirect()->route('profile');                   
   }
    
   public function addtostore(Request $request){
         $product=new Product();

     if ($request->isMethod('post')) {
        $parametre = $request->except(['_token']);
        // var_dump( $parametre);
        $product->name = $parametre['product_name'];
        $product->cost = $parametre['product_cost'];
        $product->marque = $parametre['product_marque'];
        $product->quantite = $parametre['quant'];
        $product->categorie_id = $parametre['catg'];
        $product->color = $parametre['color'];
        $product->descreption = $parametre['desc'];
        $product->path = $parametre['path'];
          $product->user_id=Auth::user()->id;
        $dest = 'img/';
        $name=str_random(5) . '_' . $product->path->getClientOriginalName();
        $product->path->move($dest, $name);
        $product->path = $name;

        $product->save();

        
        //return $parametre;
          return redirect()->route('store');
}
    return redirect()->route('store');
}


public function deleteProduct($id){
       $p =Product::where('id', '=', $id)->first();
       $p->delete();
       return redirect()->route('store');
     }

     public function updateProduct(Request $request,$id){
       $product =Product::where('id', '=', $id)->first();
       
    if ($request->isMethod('post')) {
        $parametre = $request->except(['_token']);
        // var_dump( $parametre);
        $product->name = $parametre['product_name'];
        $product->cost = $parametre['product_cost'];
        $product->marque = $parametre['product_marque'];
        $product->quantite = $parametre['quant'];
        $product->categorie_id = $parametre['catg'];
        $product->color = $parametre['color'];
        $product->descreption = $parametre['desc'];

        $product->path = $parametre['path'];
          //   echo $vd->path->getMaxFilesize();
          $product->user_id=Auth::user()->id;
        $dest = 'img/';
        $name=str_random(5) . '_' . $product->path->getClientOriginalName();
        $product->path->move($dest, $name);
        $product->path = $name;
        $product->save();
          return redirect()->route('store');
}
    return redirect()->route('store');
     }

     public function allproduct()
    {
        $products = Product::paginate(6);
        $cats = Categorie::all();
        return view('product')->with('products',$products)->with('cats',$cats);
    }

   public function productByCategorie($id)
    {
        $products = Product::where('categorie_id', '=', $id)->paginate(6);;
     
        $cats = Categorie::all();
        return view('product')->with('products',$products)->with('cats',$cats);
    }
    
 
       public function findbytag($tag)
    {
        $products = Product::where('descreption', 'RLIKE', $tag)->paginate(6);
     
        $cats = Categorie::all();
        return view('product')->with('products',$products)->with('cats',$cats);
    }
       public function productDetails($id)
    {
         $cats = Categorie::all();
        $product = Product::where('id', '=', $id)->first(); 
        $owner=User::all();
    
        return view('productDetails')->with('product',$product)->with('cats',$cats)->with('owner',$owner);
    }
    public function comment(Request $request,$id){
       $commnet =new Comment();
       
    if ($request->isMethod('post')) {
        $parametre = $request->except(['_token']);
        // var_dump( $parametre);
        $commnet->content = $parametre['content'];
        $commnet->product_id = $id;
        $commnet->user_id = Auth::user()->id;
        $commnet->save();
    return redirect()->route('productDetails',['id'=>$id]);
     }else 
    return redirect()->route('productDetails',['id'=>$id]);
    }

    public function addtocart($id){
        $cart=Cart::where('user_id','=',Auth::user()->id);
        $cart =new Cart();       
        $cart->user_id =Auth::user()->id;
        $cart->product_id = $id;
        $cart->save();
     return redirect()->back();
    }

public function myCheckouts(Request $request){
  if ($request->isMethod('post')) {
        $parametre = $request->except(['_token']);
  $v=Cart::where('user_id', '=', Auth::user()->id)->where('checkout_id', '=', null)->first();
  if (isset($v)) {
             $ch =new Checkout();
             $ch->user_id=Auth::user()->id;  
             $ch->save(); 
             $co=0;
        foreach (Cart::where('user_id', '=', Auth::user()->id)->where('checkout_id', '=', null)->cursor() as $c) {
             $c->checkout_id=$ch->id;
             $c->quantite=$parametre['q'.$c->product_id];
             $c->save();
         
             $product = Product::where('id', '=', $c->product_id)->first(); 
             $co= $co+$product->Cost*$c->quantite;
         }
         $ch->sum =$co;
         $ch->save();
      }
     }  
          $chk = Checkout::where('user_id','=',Auth::user()->id)->get();
       //   var_dump($chk[1]);
   return view('checkout')->with('checkout',$chk);
    }

public function mycart(){
       $cats = Categorie::all();
    return view('cart')->with('cats',$cats);
    }
    

public function deleteitem($id){
       $c =Cart::where('product_id', '=', $id)->where('user_id', '=', Auth::user()->id)->where('checkout_id', '=', null)->first();
      if (isset($c)) 
       $c->delete();
       return redirect()->route('mycart');
     }

public function sendmessage(Request $request,$id,$iid){
       $msg =new Message();
       
    if ($request->isMethod('post')) {
        $parametre = $request->except(['_token']);
        // var_dump( $parametre);
        $msg->text = $parametre['msg'];
        $msg->buyer_id = Auth::user()->id;
        $msg->seller_id =$id;
        $msg->save();
    return redirect()->route('productDetails',['id'=>$iid]);     
        }else
    return redirect()->route('productDetails',['id'=>$iid]);

      }

 public function wichlist()
    {        $c=Auth::user()->whichlist;
              if (isset($c))
             $products=Auth::user()->whichlist->products;
              else{ 
             $Wichlist=new Wichlist();
             $Wichlist->user_id=Auth::user()->id;
             $Wichlist->save();
             $user=Auth::user();
             $user->wichlist_id=$Wichlist->id;
             $user->save();
             $products=null;
            }
       $cats = Categorie::all();
      return view('wichlist')->with('cats',$cats)->with('products',$products);
    }

 public function deletewich()
    {    
       $c=Auth::user()->whichlist;
       if (isset($c)){
         $c->products()->detach();
         $c->delete(); }
      return redirect()->route('wichlist');
    }
    

    public function addtowich($id){
              $c=Auth::user()->whichlist;
              if (!isset($c)){
             $Wichlist=new Wichlist();
             $Wichlist->user_id=Auth::user()->id;
             $Wichlist->save();
             $user=Auth::user();
             $user->wichlist_id=$Wichlist->id;
             $user->save();
                 }
         $product = Product::where('id', '=', $id)->first();
         $w = Wichlist::where('user_id', '=', Auth::user()->id)->first();
         $w->products()->save($product);
        return redirect()->route('wichlist');

     }
    
     

   public function bill($id){
        $checkout = Checkout::where('id','=',$id)->first();
        //  $carts=$checkout->carts;
        $html = view('bill')->with('checkout',$checkout)->render();
       return PDF::load($html)->show();
  }
}
