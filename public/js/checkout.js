$(document).ready(function(){

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });


    $('#district_id').on('change', function () {
        var nameId = this.value;
          $('#upazila_id').html('');
        $.ajax({
            url:'/upazila_id_fetch?district_id='+nameId,
            type:'get',
            success: function (res) {
                $('#upazila_id').html('<option value="" selected disabled> Select Area </option>');
                 $.each(res, function (key, value) {
                     $('#upazila_id').append('<option  value="' + value
                        .id + '">' + value.name + '</option>');
               });
           }
       });
    });


    $('#upazila_id').on('change', function () {
        var nameId = this.value;
          $('#union_id').html('');
        $.ajax({
            url:'/union_id_fetch?upazila_id='+nameId,
            type:'get',
            success: function (res) {
                $('#union_id').html('<option value="" selected disabled> Select Zone </option>');
                 $.each(res, function (key, value) {
                     $('#union_id').append('<option  value="' + value
                        .id + '">' + value.name + '</option>');
               });
           }
       });
    });



    $("#add_order_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $.ajax({
          type:'POST',
          url:"/confirm_order",
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          beforeSend : function(){
                $("#add_order_btn").prop('disabled', true).text('Processing...');
            },
           success: function(response){
                 $("#add_order_btn").prop('disabled', false).text('Confirm Order');
                 if(response.status=='success'){
                     // console.log(response);
                      Swal.fire("Success",response.message, "success");
                       window.location.href="/"       
                 }else{
                      Swal.fire("Warning",response.message, "warning");
                 }       
             }
        });

      });



    fetchAll_check_out_count();
    function fetchAll_check_out_count() {
       $.ajax({
           type: 'GET',
           url: '/check_out_count',
          success: function(response) {
                   console.log(response);
             if (response.status == "success") {
                    $('#subtotal_amount').text(response.total_amount+"TK");
                    $('#shipping_amount').text(response.shipping_amount+"TK");
                    $('#total_amount').text(response.total_amount+"TK");
                    $('#payble_amount').text(response.total_amount+"TK");
               }
           }
         });
      }
   });
  