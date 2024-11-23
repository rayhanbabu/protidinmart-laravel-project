@extends('layouts/frontendheader')
@section('content')

<!-- My Orders Section -->
<section class="max-w-4xl mx-auto p-2 sm:p-6 mt-6  rounded-md ">
  

   <div class="bg-white shadow-lg pt-5 rounded-lg" >
 
    <!-- Orders List -->
    <div class="space-y-6">


    @foreach ($order as $row)
      <!-- Order 1 -->
      <div class="p-4 bg-white ">
        <div class="flex flex-col sm:flex-row justify-between items-start mb-4">
          <p>Your Order ID: 
            <a href="#" class="text-green-600">{{$row->id}}</a> 
          </p>

          <div class="flex space-x-2 gap-3 mt-3">
             @if($row->status=='PENDING') 
                <span class="bg-yellow-500 text-warning px-3 py-1 rounded-md"> PENDING </span>
             @else
             <span class="bg-green-500 text-white px-3 py-1 rounded-md">  {{$row->status}}  </span>
              <a href="{{url('order_track/'.$row->id)}}" class="bg-blue-500 text-white px-3 py-1 rounded-md flex items-center">
                <i class="fa fa-location-arrow mr-2"></i> Track My Order
             </a>

             @endif
          </div>


        </div>

       <!-- Products -->
       <div class="flex flex-wrap items-center gap-3">
          <!-- Product 1 -->
        @foreach( product_detail($row->id) as $item)
          <div class="flex flex-col items-left">
             <img src="{{ asset('uploads/admin/'.$item->image) }}" alt="Wild Stone" class="w-24 h-36 object-cover rounded-md mb-2">
             <p class="text-sm font-semibold">{{$item->product_name}}</p>
             <p class="text-gray-500">TK.{{$item->per_amount}} <span class="text-red-600"></span></p>
          </div>
        @endforeach
    
            <hr>
          <!-- Product 2 -->
          
        </div>
      </div>




              <hr>
      @endforeach


    </div>
</div>
  </section>

    @endsection
