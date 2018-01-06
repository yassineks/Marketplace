@extends('myapp')
@section('content')

<section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
         
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <?php $i=1; ?>
                    @foreach($categories as $c)
                    
                    <div class="panel panel-default aa-checkout-coupon">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$i}}" aria-expanded="false" class="collapsed">
                            {{$c->name}}
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne{{$i}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                   
                        <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product name</th>
                          <th>Product marque</th>
                          <th>Quantity</th>
                           <th>Cost by unit</th>
                           <th>Descreption</th>
                            <th>Delete</th>
                             <th>Update</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php $j=1; ?>
                         @foreach($c->products as $p)
                                @if($p->user_id == Auth::user()->id)
                        <tr>
                          <td> {{$p->name}}</td>
                           <td> {{$p->marque}}</td>
                          <td> {{$p->quantite}}</td>
                          <td> {{$p->Cost}}</td>
                          <td><a href="" data-toggle="modal" data-target="#modal{{$i}}{{$j}}">Infos</a></td>
                         <td><a class="text-danger" title="Delete" href="{{route('deleteProduct',['id'=>$p->id])}}"><span class="glyphicon glyphicon-trash"> </span></a></td> 
                         <td><a class="text-danger" title="Update" data-toggle="modal" data-target="#upmodal{{$i}}{{$j}}"><span class="glyphicon glyphicon-edit"> </span></a></td> 

                        </tr>
                        @endif
    <div class="modal fade" id="modal{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Product Descreption</h4>
       <img src="img/{{$p->path}}" class="simpleLens-big-image">
       <p>{{$p->descreption}}</p>
     </div></div> 
      </div></div> 

        <div class="modal fade" id="upmodal{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Update Product</h4>
            <form action="{{route('updateProduct',['id'=>$p->id])}}" method="POST"  enctype="multipart/form-data">
                  {{ csrf_field() }}
                            
                              
                           <select id="" name="catg">
                          @foreach($categories as $c)
                          <option  value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach
                          </select>
                        Quantity   <select id="" name="quant">
                               @for ($i = 1; $i < 100; $i++)
                                  <option  value="{{ $i }}">{{ $i }}</option> 
                               @endfor
                             </select>
                         <br><br>
                        <input type="text" name="product_name" placeholder="Product name">
                        <input type="text" name="product_marque" placeholder="Product marque"><br><br>
                        <input type="number" name="product_cost" placeholder="Product Cost TND">
                          Color<select id="" name="color">                  
                          <option  value="1">green</option>
                           <option  value="2">yellow</option>
                            <option  value="3">white</i></option>
                        </select>
                        
                        <br><br><br>
                        <textarea class="form-control" rows="3" placeholder="Description" name="desc"></textarea><br>
           <label class="btn btn-danger"> Browse&hellip; 
                       Images <input type="file" name="path" id="path"  accept="img/*" style="display: none;">
           </label><br><br>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">ADD</button>
                      </form>
     </div></div> 
      </div></div> 

  
        
    
                         <?php $j++; ?>
                         @endforeach
                     
                      </tbody>
                    
                    </table>
               
                      </div>
                    </div>
      
                     <?php $i++; ?>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <div class="panel panel-default aa-checkout-login">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                           Add Product
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                             <form action="{{route('addtostore')}}" method="POST" class="aa-login-form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                            <table>
                              <tr>
                               <td> <select id="" name="catg">
                          @foreach($categories as $c)
                          <option  value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach
                        </select><br><br></td>
                        <td>Quantity<br><br></td>
                               <td>
                                 <select id="" name="quant">
                               @for ($i = 1; $i < 100; $i++)
                                  <option  value="{{ $i }}">{{ $i }}</option> 
                               @endfor
                             </select>
                                <br><br></td>

                              </tr>
                        <tr>
                          <td><input type="text" name="product_name" placeholder="Product name"><br><br>
                          </td>
                          <td></td>
                          <td></td>
                        </tr>
                      <tr>                          
                          <td><input type="text" name="product_marque" placeholder="Product marque"><br><br></td>
                         <td></td>
                          <td></td>
                        </tr>
                         <tr>                          
                          <td><input type="number" name="product_cost" placeholder="Product Cost TND"></td>
                          <td>Clor</td>
                          <td><select id="" name="color">                  
                          <option  value="1">green</option>
                           <option  value="2">yellow</option>
                            <option  value="3">white</i></option>
                        </select></td>
                        </tr>
                        </table><br>
                        <textarea class="form-control" rows="3" placeholder="Description" name="desc"></textarea><br>
           <label class="btn btn-danger"> Browse&hellip; 
                       Images <input type="file" name="path" id="path"  accept="img/*" style="display: none;">
           </label><br><br>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">ADD</button>
                      </form>
                          
                       
                          
                        </div>
                      </div>
                    </div>
               
                </div>
              </div>
            </div>
          
         </div>
       </div>
     </div>
   </div>
 </section>

@endsection      