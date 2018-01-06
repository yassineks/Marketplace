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

               @if (Auth::user())
               @if (Auth::user()->role='buyer')
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
              @endif
              @endif
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
              <li><a href="{{route('contact')}}">Contact</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div> 
      </div>
    </div>
  </section>
  <!-- / menu -->  
 
  <!-- catg header banner section -->


  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
               
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
              	<?php $i=1; ?>
                 @foreach ($products as $productss)  

                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="{{route('productDetails',['id'=>$productss->id])}}"><img src="img/{{$productss->path}}" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="{{route('addtocart',['id'=>$productss->id])}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#"> {{$productss['name']}}</a></h4>
                      <span class="aa-product-price">${{$productss['Cost']}}</span>
                      <p class="aa-product-descrip">{{$productss->descreption}}</p>
                    </figcaption>
                  </figure>                          
                  <div class="aa-product-hvr-content">
                    <a href="{{route('addtowich',['id'=>$productss->id])}}" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal{{$i}}"><span class="fa fa-search"></span></a>
                  </div>
                </li>   








              <div class="modal fade" id="quick-view-modal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/{{$productss->path}}">
                                          <img src="img/{{$productss->path}}" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>


                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3> {{$productss['name']}}</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">${{$productss['Cost']}}</span>
                              <p class="aa-product-avilability">Avilability: <span>{{$productss->quantitie}} In stock</span></p>
                            </div>
                           <p>{{$productss->descreption}}</p>
                            <h4>Size</h4>                           
                            <div class="aa-prod-quantity">
                              <p class="aa-prod-category">
                                Category: <a href="#">{{$productss->categorie->name}}</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="{{route('addtocart',['id'=>$productss->id])}}" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="{{route('productDetails',['id'=>$productss->id])}}" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>



              		 	<?php $i++ ; ?>
                  @endforeach
              </ul>
              <!-- quick view modal -->                  
              <!-- / quick view modal -->   
            </div>
            <div class="aa-product-catg-pagination">
               
              {{ $products->links() }}

            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                @foreach($cats as $cat)
                <li><a href="{{route('productByCategorie',['id'=>$cat->id])}}">{{$cat->name}}</a></li>
                @endforeach
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                <a href="{{route('findbytag',['tag'=>'Fashion'])}}">Fashion</a>
                <a href="{{route('findbytag',['tag'=>'Shop'])}}">Shop</a>
                <a href="{{route('findbytag',['tag'=>'Bag'])}}">Hand Bag</a>
                <a href="{{route('findbytag',['tag'=>'Laptop'])}}">Laptop</a>
                <a href="{{route('findbytag',['tag'=>'Phone'])}}">Head Phone</a>
                <a href="{{route('findbytag',['tag'=>'Pen'])}}">Pen Drive</a>
              </div>
            </div>

            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                   @foreach ($products->take(4) as $productss) 
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/{{$productss->path}}"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">{{$productss->name}}</a></h4>
                      <p>{{$productss->Cost}} DNT</p>
                    </div>                    
                  </li>
                      @endforeach                             
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->






@endsection