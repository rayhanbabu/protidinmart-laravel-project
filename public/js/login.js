$(document).ready(function(){ 
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });


    $(document).on('submit', '#phone_form', function(e){
        e.preventDefault();
        var phone=$('#phone').val();
        let phoneData=new FormData($('#phone_form')[0]);

        $.ajax({
             type:'POST',
             url:'/member/login_verify',
             data:phoneData,
             contentType: false,
             processData:false,
             beforeSend : function()
              {
                 $("#phone_form_btn").prop('disabled', true).text("Loading...");
              },
             success:function(response){ 
                console.log(response);
                $("#phone_form_btn").prop('disabled', false).text("Submit");
              if(response.status == "success"){
                   $('#code_phone').val(phone);
                   $('.phoneform').hide();
                   $('.codeform').show();
               }else{
                   $('.error_phone').text(response.message.phone);
               }    
              }
         });

     

      });


      $(document).on('submit', '#code_form', function(e){
        e.preventDefault();
        var code_phone=$('#code_phone').val();
        var otp=$('#otp').val();
        let codeData=new FormData($('#code_form')[0]);
     
        $.ajax({
             type:'POST',
             url:'/member/login_insert',
             data:codeData,
             contentType: false,
             processData:false,
             beforeSend : function()
              {
                $("#phone_code_btn").prop('disabled', true).text("Loading...");
              },
             success:function(response){ 
                // console.log(response);
                $("#phone_code_btn").prop('disabled', false).text("Submit");
                if(response.status == "success"){
                // $('#email_id_pass').val(email_id);
                // $('#forget_code_id').val(forget_code);
                $('.confirmpass').show();
                $('.emailform').hide();
                $('.codeform').hide();
                }else{
                  Swal.fire("Invalid Code ", "Please try again", "warning");
                }  
                
                $('.loader').hide();
              }

         });
 
      });







    });
