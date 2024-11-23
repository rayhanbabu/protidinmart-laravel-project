@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('contact','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
   <div class="card-header">
       <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Contact @if(!$id) Add @else Edit @endif </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/contact')}}" role="button"> Back </a>
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
  <form method="post" action="{{url('admin/contact/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">

          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Name <span style="color:red;"> * </span></b></label>
               <input type="text" name="name" class="form-control" value="{{$name}}" required>
          </div> 


          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Email <span style="color:red;"> * </span></b></label>
               <input type="text" name="email" class="form-control" value="{{$email}}" required>
          </div> 

          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Subject <span style="color:red;"> * </span></b></label>
               <input type="text" name="subject" class="form-control" value="{{$subject}}" required>
          </div> 

          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Message <span style="color:red;"> * </span></b></label>
               <input type="text" name="message" class="form-control" value="{{$message}}" required>
          </div> 
            
            <div class="form-group col-sm-6  my-2">
                <label class=""><b> contact Status  </b></label>
                 <select class="form-select" name="contact_status"  aria-label="Default select example">
                      <option value="1" {{ $contact_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $contact_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 

           

       </div>
           <br>
        <input type="submit"   id="insert" value="Submit" class="btn btn-success" />
	  
              
     </div>

     </form>

  </div>
</div>









   


@endsection