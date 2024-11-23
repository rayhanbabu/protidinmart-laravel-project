@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('union','active')
@section('content')

       <form method="get" enctype="multipart/form-data"> 
          <div class="row p-2 shadow shadow-sm">
                   <div class="col-4"> <h5 class="mt-0">
                          Select  Upazila / Area
                     </h5>  </div>

                   <div class="col-6">
                       <div class="d-grid gap-2 d-md-flex justify-content-md-start"> 
                            <select name="upazila_id" id="upazila_id"  class="form-control form-control-sm js-example-disabled-results" style="max-width:300px;" required>
                                <option value=""> Select Upzila / Area </option>
                                  @foreach(upazila() as $row)
                                   <option value="{{ $row->id }}" {{ $upazila_id == $row->id ? 'selected' : '' }} >
                                       {{ $row->name }} -  {{ $row->bn_name }}
                                    </option>
                                  @endforeach
                             </select>
                        </div>
                    </div>

                    
                   <div class="col-2">
                      <div class="d-grid gap-2 d-md-flex ">
                          <input type="submit" id="insert" value="Search" class="btn btn-success btn-sm" />
                      </div>
                   </div> 
              </form>
          </div>

   @if($upazila_id)
      <div class="card mt-2 mb-2 shadow-sm">
         <div class="card-header">
              <div class="row">
                  <div class="col-8"> <h5 class="mt-0">  Union / Zone  </h5></div>
                       <div class="col-2">
                          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                 
                          </div>
                      </div>

                    
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('address/union/manage/'.$upazila_id)}}" role="button"> Add </a>
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
                <table class="table table-bordered data-table">
                   <thead>
                     <tr>
                         <td> Id </td>
                         <td> City Name </td>
                         <td> City Name (Bangla) </td>
                         <td> Status </td>
                         <td> Edit  </td>
                         <td> Delete </td>
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
           url: "{{ url('/address/union?upazila_id='.$upazila_id) }}",
           error: function(xhr, error, code) {
               console.log(xhr.responseText);
           }
       },
       order: [[0, 'desc']],
       columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'bn_name', name: 'bn_name'},
            {data: 'status', name: 'status'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},
         ]
     });
  });

   </script>

   @endif

   <script type="text/javascript">
         $(".js-example-disabled-results").select2();
   </script>


      



   


@endsection