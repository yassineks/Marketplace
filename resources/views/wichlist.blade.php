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
   <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href="{{route('home')}}">Home</a></li>
             <li><a href="{{route('allproduct')}}">All Product</a></li>

               @foreach($cats as $cat)
              <li><a href="{{route('productByCategorie',['id'=>$cat->id])}}">{{$cat->name}}</a></li>    
              @endforeach                 
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div> 
      </div>
    </div>
  </section>
 
 
 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">          
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><a class="remove" href="{{route('deletewich')}}"><fa class="fa fa-close"></fa></a></th>
                        <th>Img</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @if (isset($products))
                        @foreach($products as $pr)
                      <tr>
                        <td></td>
                        <td><a href="#"><img src="img/{{$pr->path}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$pr->name}}</a></td>
                        <td>{{$pr->Cost}}</td>
                        
                      </tr>
                      @endforeach
                      @endif
                   </tbody>
                  </table>
                </div>

           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

@endsection