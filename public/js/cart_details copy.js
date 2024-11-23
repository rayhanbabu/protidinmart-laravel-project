$(document).ready(function(){

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });


    function fetchAll_cart() {
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



     fetchAll();
     function fetchAll(){
      $.ajax({
        type: 'GET',
        url: '/cart-details-fetch',  // Ensure the correct route URL
        success: function(response) {
          //console.log(response); 
          var cart=response.cart;
          // Ensure response is an array of cart items
          let cartItemsContainer = $("#cart-items-container"); // Assuming a div for holding cart items
          cartItemsContainer.empty(); // Clear any previous cart items 
          
          if(cart.length === 0) {
            window.location.href = '/cart-details';    
          }else { 
          $('.check_out_payment').show();
          cart.forEach(function(item){
            let cartItemHTML = `
              <div
                class="cart_item shadow-lg bg-[#f2f2f2] p-4 flex items-center rounded-lg justify-between mb-1"
              >
                <!-- Image -->
                <div class="w-24 h-24">
                  <img
                    src="/uploads/admin/${item.image}" 
                    alt="cart_image"
                    class="w-full h-full object-cover"
                  />
                </div>
      
                <!-- Title and Quantity -->
                <div class="ml-4">
                  <h2 class="text-xl font-semibold">${item.product_name}</h2> 
                  <!-- Quantity and Delete -->
                  <div class="flex items-center mt-2">
                    <label for="quantity-${item.id}" class="mr-2">Qty:</label>
                     <input
                     type="number"
                     id="quantity-${item.id}"
                     name="quantity"
                     min="1"
                     value="${item.qty}"  
                    class="quantity-input w-16 p-1 border rounded mr-4"
                    data-id="${item.id}" 
                 />
                    <button class="delete-item text-red-500 hover:text-red-700" data-id="${item.id}">Delete</button>
                  </div>
                </div>
      
                <!-- Price -->
                <div class="text-lg font-semibold text-right">${item.amount*item.qty} TK</div> 
              </div>
            `;
            cartItemsContainer.append(cartItemHTML); // Append each cart item
          });
        }

          $('.delete-item').on('click', function() {
            let itemId = $(this).data('id'); // Get the item ID from data attribute
            deleteCartItem(itemId); // Call the delete function with the item ID
          });


           // Attach the change event listener to the quantity input fields
         $('.quantity-input').on('change', function() {
               let itemId = $(this).data('id'); // Get the item ID from data attribute
               let newQuantity = $(this).val(); // Get the new quantity
               updateCartQuantity(itemId, newQuantity); // Call the function to update quantity
              // alert(newQuantity);
          });
  
       
        }

        });
    }



    function deleteCartItem(itemId) {
      $.ajax({
         type: 'POST',
         url: '/cart-delete-item',  // Replace with the correct URL for deleting an item
         data: {
           id: itemId,  // Pass the item ID to the server
         },
         success: function(response) {
          if(response.status=='success') {
            //$(`[data-id="${itemId}"]`).closest('.cart_item').remove();
            //alert('Item deleted successfully');
             fetchAll_cart();
             fetchAll();
          } else {
            
          }
        },
        error: function(xhr) {
          alert('Error deleting item');
        }
      });
    }



    function updateCartQuantity(itemId, newQuantity) {
      $.ajax({
        type: 'POST',
        url: '/cart-update-quantity',  // Replace with the correct URL for updating the quantity
        data: {
          id: itemId,
          quantity: newQuantity,
        },
        success: function(response) {
          if(response.status=="success") {
            fetchAll();
            fetchAll_check_out_count();
            // Optionally update the total price or other details here
          } else {
            alert('Error  3 updating quantity');
          }
        },
        error: function(xhr) {
          //alert('Error 1 updating quantity');
        }
      });
    }



  

});



  