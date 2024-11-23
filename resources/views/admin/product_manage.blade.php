@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('product','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
   <div class="card-header">
       <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Product @if(!$id) Add @else Edit @endif </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/product')}}" role="button"> Back </a>
                         </div>
                     </div> 
         </div>

       @if($errors->any())
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
  <form method="post" action="{{url('admin/product/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">

     <div class="form-group col-sm-3 my-2">
               <label class=""><b> Category Name <span style="color:red;"> * </span></b></label><br>
                 <select name="category_id" id="category_id"  class="form-control js-example-disabled-results" style="max-width:300px;" required>
                  <option value=""> Select Categeory </option>
                   @foreach($category as $row)
                      <option value="{{ $row->id }}" {{ $row->id == $category_id ? 'selected' : '' }}>
                          {{ $row->category_name }}
                      </option>
                   @endforeach
                 </select>
           </div> 

          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Brand Name <span style="color:red;"> * </span></b></label><br>
                 <select name="brand_id" id="brand_id"  class="form-control js-example-disabled-results" style="max-width:300px;" required>
                  <option value="">Select Brand </option>
                   @foreach($brand as $row)
                      <option value="{{ $row->id }}" {{ $row->id == $brand_id ? 'selected' : '' }}>
                          {{ $row->brand_name }}
                      </option>
                   @endforeach
                 </select>
           </div> 

          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Product Name <span style="color:red;"> * </span></b></label>
               <input type="text" name="product_name" class="form-control form-control-sm" value="{{$product_name}}" required>
          </div> 


      

          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Serial </b></label>
               <input type="number" name="serial" class="form-control form-control-sm" value="{{$serial}}" >
          </div> 

          <div class="form-group col-sm-2  my-2">
                <label class=""><b>product Status <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="product_status"  aria-label="Default select example">
                      <option value="1" {{ $product_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $product_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 

           <div class="form-group col-sm-2 my-2">
              <label class=""><b> Product Image  </b></label>
              <input type="file" name="image"  class="form-control" placeholder="" >
          </div>
            


         <div class="form-group col-sm-2 my-2">
               <label class=""><b> Per Amount <span style="color:red;"> * </span></b></label>
               <input type="number" name="amount" class="form-control form-control-sm" value="{{$amount}}" required>
         </div> 


        

         <div class="form-group col-sm-2  my-2">
                <label class=""><b> Show Category   </b></label>
                 <select class="form-select form-select-sm" name="show_category"  aria-label="Default select example">
                       <option value="" > Select One </option>
                       <option value="Top" {{ $show_category == 'Top' ? 'selected' : '' }}> Top </option>
                       <option value="Latest" {{ $show_category == 'Latest' ? 'selected' : '' }}> Latest </option>
                </select>
           </div> 


           <div class="form-group col-sm-2  my-2">
                <label class=""><b> Size Show <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="size_show"  aria-label="Default select example" required>
                       <option value="Yes" {{ $size_show == 'Yes' ? 'selected' : '' }}> Yes </option>
                       <option value="No" {{ $size_show == 'No' ? 'selected' : '' }}> No </option>
                </select>
           </div> 

           <div class="form-group col-sm-2 my-2">
               <label class=""><b> Approximate Amount <span style="color:red;"> * </span></b></label>
               <input type="number" name="approximate_amount" class="form-control form-control-sm" value="{{$approximate_amount}}" required>
         </div> 


        <div class="form-group col-sm-12 my-2">
              <label class=""><b> Description  <span style="color:red;"> * </span></b></label>
              <textarea name="desc" id="summernote" cols="30" rows="10" > {{$desc}}  </textarea >
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

    $('#summernote').summernote({
placeholder: 'Description...',
tabsize: 2,
height: 60
});
</script>




   


@endsection