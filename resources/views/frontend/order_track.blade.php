@extends('layouts/frontendheader')
@section('content')
<!-- main -->
<div class="max-w-screen-lg mx-auto mt-5 rounded-lg">
    <div class="flex flex-col">
        <!-- Vertical Order Tracking Timeline -->
        <div class="bg-white  rounded-lg shadow-lg mb-5 p-5 sm:p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-6">Order Tracking</h2>
            <div class=" ">
                <!-- Order Placed -->
                <div class="flex items-center {{$order->status=='APPROVED'?'active':'inactive'}}">
                    <i class="fas fa-shopping-cart  text-3xl"></i>
                    <div class="ml-4">
                        <p class="font-semibold">Order Placed</p>
                        <p class="text-sm text-gray-500">Your order has been placed successfully.</p>
                    </div>
                </div>
                
                <div class="h-10 border-l-4  ml-3"></div>

                <!-- Ready to Ship -->
                <div class="flex items-center  {{$order->status=='ON_SHIPPING'?'active':'inactive'}} ">
                    <i class="fas fa-box  text-3xl"></i>
                    <div class="ml-4">
                        <p class=" font-semibold">Ready to Ship</p>
                        <p class="text-sm text-gray-500">Your order is packed and ready to ship.</p>
                    </div>
                </div>
                <div class="h-10 border-l-4  ml-3"></div>

                <!-- Handover to Courier -->
                <div class="flex items-center  {{$order->status=='SHIPPED'?'active':'inactive'}} ">
                    <i class="fas fa-truck  text-3xl"></i>
                    <div class="ml-3">
                        <p class=" font-semibold">Handover to Courier</p>
                        <p class="text-sm text-gray-500">Your order has been handed over to the courier.</p>
                    </div>
                </div>
                <div class="h-10 border-l-4  ml-3"></div>

              <!-- Order Completed
                Order Delivered
                <div class="flex items-center active ">
                    <i class="fas fa-box-open  text-3xl"></i>
                    <div class="ml-3">
                        <p class=" font-semibold">Delivered</p>
                        <p class="text-sm text-gray-500">Your order has been delivered successfully.</p>
                    </div>
                </div>
                <div class="h-10 border-l-4 ml-3"></div>
                 -->

                <!-- Order Completed -->
                <div class="flex items-center {{$order->status=='COMPLETED'?'active':'inactive'}}">
                    <i class="fas fa-check-circle  text-3xl"></i>
                    <div class="ml-4">
                        <p class=" font-semibold">Order Completed</p>
                        <p class="text-sm text-gray-500">Your order has been Completed.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchased Products and Order Summary -->
        <div class="bg-white p-3 rounded-lg shadow-lg sm:p-6 mb-5">
            <!-- Demo Products Section -->
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Purchased Products</h2>

          @foreach( product_detail($order->id) as $item)
            <div class="flex flex-col gap-4 mb-6">
                <!-- Product 1 -->
                <div class="bg-white p-4 shadow rounded-lg flex items-center justify-between">
                   <img src="{{ asset('uploads/admin/'.$item->image) }}" alt="laptop" width="100">                  
                        <p class="font-semibold text-gray-700">{{$item->product_name}}</p>
                        <p class="text-sm text-gray-500">Quantity: {{$item->qty}}</p>
                        <p class="text-sm text-gray-500">Price: {{$item->per_amount}} </p>                   
                </div>
                <!-- Product 2 -->
              </div>
          @endforeach

            <!-- Order Summary -->
            <div class="p-6 bg-gray-50 shadow rounded-lg">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Order Summary</h2>
                <div class="space-y-4">
                 
                    <div class="flex justify-between">
                         <p class="text-gray-600">Sub Total</p>
                         <p class="font-semibold text-gray-700"> {{ $order->total_amount }} TK</p>
                    </div>

                    <div class="flex justify-between">
                         <p class="text-gray-600">Shipping</p>
                         <p class="font-semibold text-gray-700"> {{ $order->shipping_amount }} TK </p>
                    </div>

                    <div class="flex justify-between">
                         <p class="text-gray-600">Discount </p>
                         <p class="font-semibold text-gray-700"> {{ $order->discount_amount }} TK </p>
                    </div>
                   
                    <div class="flex justify-between">
                        <p class="text-gray-600">Payable Amount</p>
                        <p class="font-semibold text-gray-700">   {{ $order->net_amount }} TK  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- main -->


    @endsection
