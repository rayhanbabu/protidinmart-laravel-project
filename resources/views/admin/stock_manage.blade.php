@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('stock','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
   <div class="card-header">
       <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Stock @if(!$id) Add @else Edit @endif </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/stock')}}" role="button"> Back </a>
                         </div>
                     </div> 
         </div>

       @if ($errors->any())
          <div class="alert alert-danger">
             <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
           </div>
       @endif

            @if(Session::has('fail'))
                <div  class="alert alert-danger"> {{Session::get('fail')}}</div>
            @endif
                           
             @if(Session::has('success'))
                   <div  class="alert alert-success"> {{Session::get('success')}}</div>
             @endif

  </div>

  <div class="card-body">    
      <form method="post" action="{{url('admin/stock/insert')}}"  class="myform"  enctype="multipart/form-data" >
        {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">


       <div class="form-group col-sm-3 my-2">
               <label class=""><b> Product Name <span style="color:red;"> * </span></b></label><br>
                 <select name="product_id" id="product_id"  class="form-control js-example-disabled-results" style="max-width:300px;" required>
                  <option value="">Select Product Name </option>
                   @foreach($product as $row)
                      <option value="{{ $row->id }}" {{ $row->id == $product_id ? 'selected' : '' }}>
                          {{ $row->product_name }}
                      </option>
                   @endforeach
                 </select>
           </div> 

           <div class="form-group col-sm-3  my-2">
                <label class=""><b>Unit</b></label>
                 <select class="form-select form-select-sm" name="unit"  aria-label="Default select example">
                      <option value="Unit" {{ $unit == 'Unit' ? 'selected' : '' }}> Unit </option>
                      <option value="Kg" {{ $unit == 'Kg' ? 'selected' : '' }}> Kg </option>
                </select>
           </div> 


          <div class="form-group col-sm-3 my-2">
               <label class=""><b>Qty  <span style="color:red;"> * </span></b></label>
               <input type="number" name="qty" class="form-control form-control-sm" value="{{$qty}}" required>
          </div> 

      
          <div class="form-group col-sm-3 my-2">
               <label class=""><b>Per Amount  <span style="color:red;"> * </span></b></label>
               <input type="number" name="per_amount" class="form-control form-control-sm" value="{{$per_amount}}" required>
          </div> 

         


            <div class="form-group col-sm-3  my-2">
                <label class=""><b>stock Status </b></label>
                 <select class="form-select form-select-sm" name="stock_status"  aria-label="Default select example">
                      <option value="1" {{ $stock_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $stock_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 

           

       </div>
           <br>
        <input type="submit"   id="insert" value="Submit" class="btn btn-success" />
	  
              
     </div>

     </form>

  </div>
</div>





<script type="text/javascript">
      $(".js-example-disabled-results").select2();
</script>



   


@endsection