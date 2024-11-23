@extends('layouts/frontendheader')
@section('content')


@if($cart=="empty")
        <section class="w-full py-10">
            <div class="max-w-screen-lg mx-auto px-2 flex flex-wrap">    
                    <h1 class="text-center w-full"> Cart Empty </h1>
             </div>
       </section>
    @else
  
<section class="w-full py-10">
      <div class="max-w-screen-lg mx-auto px-2 flex flex-wrap">
        <!-- Cart Items Section -->
        <div class="w-full lg:w-2/3 mb-8 lg:mb-0 mt-3">


        <div id="cart-items-container"> </div>
        
      
         
          <!-- Coupon Code and Checkout Bar -->
          <div
            class="flex items-center bg-white justify-between p-4 border-t mt-4  -lg sm:flex-nowrap flex-wrap"
          >
            <div class="flex items-center">
              <label for="coupon" class="mr-2"></label>
              <input
                type="hidden"
                id="coupon"
                name="coupon"
                class="w-48 p-2 border  "
                placeholder="Enter coupon code"
              />
            </div>

            <a href="{{url('checkout')}}"
              class="bg-blue-500 text-white px-4 py-2  hover:bg-blue-700 mt-3 sm:mt-0 inline-block" >
              Proceed to Checkout
            </a>
          </div>
        </div>

    
        <!-- Address and Summary Section -->
        <div class="w-full lg:w-1/3 p-4 lg:pl-8">

          @if($address)
          <!-- Address Section -->
          <div class="mb-8 bg-white p-3 shadow-lg relative">
            <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
            
            <a href="{{url('/address_edit')}}"
                 class="absolute top-3 right-3 text-blue-500 hover:text-blue-700"> Edit
             </a>

            <p class="border p-4 rounded"> {{$address->name}} <br>
              {{$address->phone}} </p>
            <p class="border p-4 rounded">
               {{ $address->address }} ,  {{$address->union_name }}
               {{ $address->upazila_name }}  {{$address->district_name }}
            </p>
          </div>
          @endif

          <!-- Summary Section -->
          <div
            class="summary shadow-lg border-dotted border-2 p-4   bg-white"
          >
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

            <!-- Summary Items -->
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between">
                <span>Subtotal</span> <span id="subtotal_amount" >0 TK</span>
              </p>
            </div>
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between">
                <span>Shipping</span> <span id="shipping_amount" >0 TK</span>
              </p>
            </div>
            <div class="mb-2 border-b pb-2">
              <p class="flex justify-between">
                <span>Total </span> <span id="total_amount">0 TK</span>
              </p>
            </div>
            <div class="mb-2">
              <p class="flex justify-between">
                <span>Payble Amount</span> <span id="payble_amount" >0 TK</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="{{ asset('/js/cart_details.js') }}"></script>

    @endif
   
 @endsection
