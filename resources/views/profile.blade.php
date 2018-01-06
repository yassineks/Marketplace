@extends('myapp')
@section('content')
      
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
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
 <section id="aa-myaccount">

   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Profile Infos</h4>
                
                  <label for="">name : {{Auth::user()->name}}</label><br>
                   <label for="">Username or Email address : {{Auth::user()->email}}</label><br>
<label for="Gender">Gender : {{Auth::user()->sexe}}</label><br>
<label for="Birthday">Birthday: {{Auth::user()->birthday}}</label><br>

                 </div>
                 <div class="aa-myaccount-login">
   
                <br><br><h4>Update Profile</h4>
                <a class="aa-browse-btn" data-toggle="modal" data-target="#profile-modal" >Now</a>

              </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Update Login</h4> 
                
                 <form action="{{route('updateprofile')}}" method="POST" class="aa-login-form">
                 	{{ csrf_field() }}

                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" name="user_email" placeholder="Username or email">
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>

   <div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Profile</h4>
          <form class="form-horizontal" method="POST" action="{{ route('updateprofileinfos') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                  <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="birthday" required>

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                 <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">

                                 <input type="radio" name="gender" value="male"> Male
                                 <input type="radio" name="gender" value="female"> Female<br>
                                @if ($errors->has('sexe'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sexe') }}</strong>
                                    </span>
                                @endif
                            </div>
                     </div>       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <button class="aa-browse-btn" type="submit">Save</button>
                                
                            </div>
                        </div>
                    </form>
         </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>   
 <!-- / Cart view section -->
@endsection