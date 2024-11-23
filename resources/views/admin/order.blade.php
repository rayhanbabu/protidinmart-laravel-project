@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('week','active')
@section('content')

   <div class="card mt-2 mb-2 shadow-sm">
       <div class="card-header">
              <div class="row ">
                <div class="col-4"> <h5 class="mt-0"> Order History </h5></div>

              <div class="col-4">
                 <form method="get" enctype="multipart/form-data">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                       <select class="form-control" name="status" id="status" aria-label="Default select example" onchange="changeStatus(this.value)">
                            <option value="All" {{ $status === 'All' ? 'selected' : '' }}>All</option>
                            <option value="PROCESSING" {{ $status === 'PROCESSING' ? 'selected' : '' }}>PROCESSING</option>
                           <option value="APPROVED" {{ $status === 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                           <option value="ON_SHIPPING" {{ $status === 'ON_SHIPPING' ? 'selected' : '' }}>ON_SHIPPING</option>
                           <option value="SHIPPED" {{ $status === 'SHIPPED' ? 'selected' : '' }}>SHIPPED</option>
                           <option value="COMPLETED" {{ $status === 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
                           <option value="CANCELLED" {{ $status === 'CANCELLED' ? 'selected' : '' }}>CANCELLED</option>
                           <option value="RETURNED" {{ $status === 'RETURNED' ? 'selected' : '' }}>RETURNED</option>
                          <option value="PENDING" {{ $status === 'PENDING' ? 'selected' : '' }}>PENDING</option>
                     </select>

                 
                                     
                         </div>
                     </div>
                </form>
                    
                   <div class="col-2">
                       <div class="d-grid gap-2 d-md-flex ">
                            
                       </div>
                     </div> 
         </div>
           
      </div>
  <div class="card-body">   
       
   <div class="row">
       <div id="success_message"></div>

         <div class="col-md-12">
           <div class="table-responsive">
                <table class="table  table-bordered data-table">
                   <thead>
                     <tr>
                         <td> Order Id </td>
                         <td> Total Amount</td>
                         <td> Shipping Amount </td>
                         <td> Discount Amount </td>
                         <td> Payble Amount </td>
                         <td> Comment </td>
                         <td> Status </td>
                         <td> Product Detail </td>
                         <td> Edit </td>
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




 {{-- edit employee modal start --}}
  <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Edit </h5>

             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form method="POST" id="edit_employee_form" enctype="multipart/form-data">
          <input type="hidden" name="edit_id" id="edit_id">
          <div class="modal-body p-4 bg-light">
              <div class="row">

               <div class="col-lg-6 ">
                     <label class=""> Status  <span style="color:red;"> * </span> </label>
                       <select  class="form-control" name="status" id="edit_status" aria-label="Default select example">
                         <option value="PROCESSING">PROCESSING</option>
                         <option value="APPROVED">APPROVED</option>
                         <option value="ON_SHIPPING">ON_SHIPPING</option>
                         <option value="SHIPPED">SHIPPED</option>
                         <option value="COMPLETED">COMPLETED</option>
                         <option value="CANCELLED">CANCELLED</option>
                         <option value="RETURNED">RETURNED</option>
                         <option value="PENDING">PENDING</option>
                    </select>
               </div>


             <div class="col-lg-6 ">
                 <label for="roll"> Comment  </label>
                 <input type="text" name="comment" id="edit_comment" class="form-control" placeholder="" >
                 <p class="text-danger error_departmnet"></p>
             </div>

          </div>


          <div class="mt-2" id="avatar"> </div>

          <div class="loader">
            <img src="{{ asset('images/abc.gif') }}" alt="" style="width: 50px;height:50px;">
          </div>

          <div class="mt-4">
            <button type="submit" id="edit_employee_btn" class="btn btn-success">Update </button>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}


 <script> 


    function changeStatus(status) {
        window.location.href = '/admin/order/' + status;
    }

 fetchAll();
  function fetchAll() {
    // Destroy existing DataTable if it exists
   if ($.fn.DataTable.isDataTable('.data-table')) {
        $('.data-table').DataTable().destroy();
    }

  // Initialize DataTable
  var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url:"{{ url('admin/order/'.$status) }}",
          error: function(xhr, error, code) {
             // console.log(xhr.response);
          }
      },
      order: [[0, 'desc']], 
      columns: [
          { data: 'id', name: 'id'},
          { data: 'total_amount', name: 'total_amount'},
          { data: 'shipping_amount', name: 'shipping_amount'},
          { data: 'discount_amount', name: 'discount_amount'},
          { data: 'net_amount', name: 'net_amount'},
          { data: 'comment', name: 'comment' },
          { data: 'order_status', name: 'order_status' },
          { data: 'product_detail', name: 'product_detail'},
          { data: 'edit', name: 'edit', orderable: false, searchable: false },
          { data: 'delete', name: 'delete', orderable: false, searchable: false }
      ]
  });
}

 </script>


<script src="{{ asset('js/order.js') }}"></script>






@endsection