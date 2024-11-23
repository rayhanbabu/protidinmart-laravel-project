$(document).ready(function(){

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

    $("#edit_address_form").submit(function(e) {
      e.preventDefault();

      // alert('Rayhan babu');
      const fd = new FormData(this);
      $.ajax({
        type:'POST',
        url:"/address_update",
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend : function(){
              $("#edit_address_btn").prop('disabled', true).text('Updating...');
          },
         success: function(response){
                $("#edit_address_btn").prop('disabled', false).text('Update');
                 if(response.status=='success'){
                     // console.log(response);
                      Swal.fire("Success",response.message, "success");
                      window.location.href="/cart-details"       
                 }else{
                      Swal.fire("Warning",response.message, "warning");
                 }       
           }
        });
     });



       
       fetch();
      function fetch() {

          $.ajaxSetup({
               headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
             });
         

          $.ajax({
               type: 'GET',
               url: '/address_fatch',
               success: function(response) {
                 //console.log(response);
                 if (response.status == 404) {
                   $('#success_message').html("");
                   $('#success_message').addClass('alert alert-danger');
                   $('#success_message').text(response.message);
                 } else {
                   $('#edit_phone').val(response.edit_value.phone);
                   $('#edit_name').val(response.edit_value.name);
                   $('#district_id').val(response.edit_value.district_id);
                   $('#upazila_id').val(response.edit_value.upazila_id);
                   $('#union_id').val(response.edit_value.union_id);
                   $('#edit_address').val(response.edit_value.address);
                   $('#edit_alternative_phone').val(response.edit_value.alternative_phone);               
                 }
               }
             })
      }
 

     


});