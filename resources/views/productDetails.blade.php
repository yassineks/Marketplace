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
                        <p>1 x {{$pr->Cost}} DNT </p>ss
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
              <li><a href="{{route('contact')}}">Contact</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div> 
      </div>
    </div>
  </section>

  <!-- / menu -->  

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="img/{{$product->path}}" class="simpleLens-lens-image"><img src="img/{{$product->path}}" class="simpleLens-big-image"></a></div>
                      </div>
                   
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$product->name}}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">{{$product->Cost}} DNT</span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                    </div>
                  <p>{{$product->descreption}}</p>
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                      <a href="#" class="aa-color-{{$product->color}}"></a>

                    </div>
                    <div class="aa-prod-quantity">
                      
                      <p class="aa-prod-category">
                        Category: <a href="#">{{$product->categorie->name}}</a>
                      </p>
                    </div>
                   <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="{{route('addtocart',['id'=>$product->id])}}">Add To Cart</a>
                      <a class="aa-add-to-cart-btn" href="{{route('addtowich',['id'=>$product->id])}}">Wishlist</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Message</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade" id="description">
                	<form method="post" action="{{route('sendmessage',['id'=>$product->owner->id,'iid'=>$product->id])}}" class="aa-review-form">
                      <div class="form-group">
                      	                   	{{ csrf_field() }}
                        <label for="message">Messege To Seller</label>
                        <textarea class="form-control" rows="3" id="message" name="msg"></textarea>
                      </div>
                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                </div>
                <div class="tab-pane fade in active" id="review">
                 <div class="aa-product-review-area">
                   <h4>Reviews</h4> 
                   <ul class="aa-review-nav">  
                     @foreach($product->comments as $comment)                
                      <li>
                        <div class="media">
                          <div class="media-left">                           
                          </div>
                          <div class="media-body">
                          	@foreach($owner as $ownerr)
                                    @if($ownerr->id ==$comment->user_id)
                            <h4 class="media-heading"><strong>{{$ownerr->name}}</strong> - <span>{{$comment->created_at}}</span></h4>
                                    @endif
                            @endforeach
                            <p>{{$comment->content}}.</p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                   </ul>
                  
                   <!-- review form -->
                   <form action="{{route('comment',['id'=>$product->id])}}" method="post" class="aa-review-form">
                   	{{ csrf_field() }}
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message" name="content"></textarea>
                      </div>
                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>

                    
                 </div>
                </div>            
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->


@endsection