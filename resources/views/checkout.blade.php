@extends('myapp')
@section('content')
        <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{route('home')}}">
                  <span class="fa fa-shopping-cart"></span>
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
                 <div class="aa-cartbox">
                <a class="aa-cart-link" href="{{route('mycart')}}">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">{{Auth::user()->purchases->count()}}</span>
                </a>
                <div class="aa-cartbox-summary">
                  <ul>
                     @foreach(Auth::user()->purchases as $pr)
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="img/{{$pr->path}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">{{$pr->name}}</a></h4>
                        <p>1 x {{$pr->Cost}} DNT </p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>
                  @endforeach
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="{{route('myCheckouts')}}">Checkout</a>
                </div>
              </div>
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                <form action="{{route('findanywhere')}}" method="post" class="aa-review-form">
                   {{ csrf_field() }}
                  <input type="text" name="index" placeholder="Search here ">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->

 
 
 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>X</th>
                        <th>Price</th>
                        <th>Products</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($checkout as $c)
                      <tr>
                        <td>{{$c->created_at}}</td>
                        <td>{{$c->sum}}</td>
                        <td>{{$c->carts->count()}}</td>

                         <td><a class="text-danger" title="Print" href="{{route('pdf',['id'=>$c])}}"><span class="glyphicon glyphicon-print"> </span></a></td> 
                        
                      </tr>
                         @endforeach
                   </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>
                     {{$checkout->sum('sum')}}
                     </td>
                   </tr>
                 </tbody>
               </table>
               <a href="{{route('myCheckouts')}}" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

@endsection