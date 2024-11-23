$(document).ready(function(){

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

     fetchAll();
     function fetchAll() {
        $.ajax({
            type: 'GET',
            url: '/cart_product_count',
            success: function(response) {
              //console.log(response);
              if (response.status == "success") {
                     $('#cart_product_count').text(response.count);
              } else {
                    $('#cart_product_count').text(0);
              }
            }
          });
     }


      // Event delegation in case the button is added dynamically
      $("#add_cart_form").submit(function(e){
      e.preventDefault();
       
         const fd = new FormData(this); 
         
         const qty = fd.get('qty');
         const size = fd.get('size');
         
          if(size==null){
            alert('Please select a size');
          }
      
         $.ajax({
             type:'POST',
             url:"/add_to_cart",
             data: fd,
             cache: false,
             contentType: false,
             processData: false,
             dataType: 'json',
             beforeSend : function()
                 {
                   $("#cart_btn").prop('disabled', true).text("Adding...");
                 },
             success: function(response){
                   $("#cart_btn").prop('disabled', false).text("Add to Cart");
               if(response.status=='success'){
                    // console.log(response);
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    fetchAll();
                 }else if(response.status=='unauthorized'){
                        window.location='/member/login';
                 }
              }
          });
       

    });




   




});
  