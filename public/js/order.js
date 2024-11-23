$(document).ready(function(){ 

       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
       
      

        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var view_id = $(this).data('id'); 
            $('#EditModal').modal('show');
               // console.log(view_id);             
            $.ajax({
              type: 'GET',
              url: '/admin/order_view/' + view_id,
              success: function(response) {
                //console.log(response);
                if (response.status == 404) {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                } else {
                    $('#edit_id').val(response.value.id);
                    $('#edit_status').val(response.value.status);
                    $('#edit_comment').val(response.value.comment);             
                }
              }
            });



          });

   
      // update employee ajax request
    $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
  
        const fd = new FormData(this);
  
        $.ajax({
          type: 'POST',
          url: '/admin/order/update',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          beforeSend: function() {
            $('.loader').show();
            $("#edit_employee_btn").prop('disabled', true);
          },
          success: function(response) {
            $("#edit_employee_btn").prop('disabled', false);
            if (response.status == 200) {
                $('#success_message').html("");
                $("#EditModal").modal('hide');
                $("#edit_employee_form")[0].reset();
                fetchAll();
            } else if (response.status == 400) {
                $('.edit_error_registration').text(response.message.registration);
                $('.edit_error_phone').text(response.message.phone);
                $('.edit_error_email').text(response.message.email);
                $('.edit_error_member_name').text(response.message.member_name);
            }
  
            $('.loader').hide();
          }
  
        });
  
      });
  
      
           // delete employee ajax request
           $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id'); 
            Swal.fire({
              title: 'Are you sure?',
              text: "You want to delete this item!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url:'/admin/member/delete',
                  method:'delete',
                  data: {
                    id: id,
                  },
                   success: function(response) {
                      //console.log(response);
                     if(response.status == 400){
                        Swal.fire("Warning",response.message, "warning");
                     }else if(response.status == 200)
                        Swal.fire("Deleted",response.message, "success");
                       fetchAll();
                  }
                });
              }
            })
          });

});