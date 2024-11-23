@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('diagnostic','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
  <div class="card-header">
  <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Product   </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/product/manage')}}" role="button"> Add </a>
                         </div>
                     </div> 
         </div>
           
         @if(Session::has('fail'))
             <div  class="alert alert-danger"> {{Session::get('fail')}}</div>
         @endif
                        
        @if(Session::has('success'))
              <div  class="alert alert-success"> {{Session::get('success')}}</div>
            @endif


      </div>
  <div class="card-body">   

   <div class="row">
         <div class="col-md-12">
           <div class="table-responsive">
                <table class="table  table-bordered data-table">
                   <thead>
                     <tr>
                         <td> Serial </td>
                         <td> Image </td>
                         <td> Categeory </td>
                         <td> Brand </td>
                         <td> Show Categeory </td>
                         <td> Product Name </td>
                         <td> Fixed Amount </td>
                         <td> Product Status</td>
                         <td> Slider Image Add </td>
                         <td> Edit </td>
                         <td> Delete </td>
                         <td> Product Slug </td>
                         <td> Approximate Amount </td>
                         <td> Size Show Status </td>
                      </tr>
                   </thead>
                   <tbody>

                   </tbody>

                </table>
          </div>
       </div>
    </div>


  </div>
</div>




<script>
       $(function() {
   var table = $('.data-table').DataTable({
       processing: true,
       serverSide: true,
       ajax: {
           url: "{{ url('/admin/product') }}",
           error: function(xhr, error, code) {
               console.log(xhr.responsediagnostic);
           }
       },
       columns: [
            {data: 'serial', name: 'serial'},
            {data: 'image', name: 'image'},
            {data: 'category_name', name: 'category_name'},
            {data: 'brand_name', name: 'brand_name'},
            {data: 'show_category', name: 'show_category'},
            {data: 'product_name', name: 'product_name'},
            {data: 'amount', name: 'amount'},
            {data: 'status', name: 'status'},
            {data: 'slider', name: 'slider'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},
            {data: 'product_slug', name: 'product_slug'},
            {data: 'approximate_amount', name:'approximate_amount'},
            {data: 'size_show', name: 'size_show'},
       ]
   });
});

   </script>


      



   


@endsection