@extends('layouts/frontendheader')
@section('content')
   <div class="max-w-screen-xl mx-auto mt-10 shadow-lg bg-white rounded-lg overflow-hidden">

     <div class="grid md:grid-cols-3 grid-cols-1">
        <!-- Left Side: Product Image -->
        <div class="p-5">
          <img style="height:350px;"
            id="mainImage"
            src="{{asset('/uploads/admin/'.$product->image)}}"
            alt="Product Image"
            class="object-contain rounded-lg product-image"
          />

          <div class="flex flex-row gap-3 mb-5">
          @foreach($product_slider as $row)
             <img
                src="{{ asset('/uploads/admin/'.$row->image) }}"
                alt="Product Image"
                class="w-16 h-16 object-cover rounded cursor-pointer"
                onclick="changeImage('{{ asset('/uploads/admin/'.$row->image) }}')"
              />
          @endforeach 
          </div>

        </div>


        <!-- Right Side: Product Information -->
        <div class="p-4 flex gap-4 col-span-2">
          <!-- Small Images -->
          

    <div class="flex flex-col items-start">
      <form  method="POST" id="add_cart_form" enctype="multipart/form-data">
            <h1 class="text-3xl font-bold text-gray-800 mb-4"> {{ $product->product_name }} </h1>
            <div class="w-1/2">
              <div class="flex items-center gap-10 font-bold justify-between">
                <p> Price </p>
                <p> Quantity </p>
              </div>
              <div class="flex gap-10 items-center justify-between mt-3">
                <b> {{$product->amount}} TK </b>

                <input
                     type="number"
                     value="1"
                     name="qty"
                     class="border-2 border-gray w-[50px]"
                     min="1"
                     step="1"
                   />
              </div>
            </div>
              <input type="hidden" name="product_id" value="{{$product->id}}" />
           
              @if($product->size_show=='Yes')
              <div class="mt-2">
              <h2 class="font-bold text-xl mb-2">Select Size</h2>
              <div class="flex items-center gap-3 my-5">
                <label class="size-option">
                  <input type="radio" name="size" value="XS" />
                  <span class="size-label">XS</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="S" />
                  <span class="size-label">S</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="M" />
                  <span class="size-label">M</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="L" />
                  <span class="size-label">L</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="XL" />
                  <span class="size-label">XL</span>
                </label>
                <label class="size-option">
                  <input type="radio" name="size" value="XXL" />
                  <span class="size-label">XXL</span>
                </label>
              </div>
            </div>
         @else
            <br><br>
            <input type="hidden" name="size" value="NA" />
         @endif
            

         <button id="cart_btn"
            class="bg-[#1B75BC] text-white hover:bg-red-400 transition duration-300 block w-full px-4 py-2 rounded-lg"
          >
            Add to Cart
          </button>
      </form>
           

            <div class="specification">
              <h2 class="text-xl mb-3 mt-10 font-bold">Specification</h2>
              <div class="flex flex-col gap-3">
                  {!! $product->desc !!}
              </div>
            </div>
           

          </div>
        </div>
      </div>
    </div>





    <!-- related products -->
    <section class="max-w-screen-xl mx-auto px-2 border rounded bg-white pb-5 mt-5">
      <div class="p-5 border-b-2">
        <h2 class="text-2xl font-semibold">Top Rated Products</h2>
      </div>
      <div
        class="products product_slider "
      >


      @foreach($product_all as $row) 
        <a
          href="{{url('product_detail/'.$row->id)}}"
          class="product transition duration-300 cursor-pointer border-2 border-[#D78D81] rounded p-2"
        >
          <div class="img_">
            <img
              src="{{asset('/uploads/admin/'.$row->image)}}"
              alt="product"
              class="w-full "
              style="height: 300px;" />
          </div>
          <h4 class="text-xl mt-2 font-bold">{{ $row->product_name }}</h4>
          <div class="price flex items-center gap-3 my-3">
            <p class="line-through text-gray-400"> {{ $row->approximate_amount }} TK </p>
            <p>{{ $row->amount }} TK</p>
          </div>
          <button
            class="bg-[#1B75BC] hover:bg-[#6aa4d2] text-white transition duration-300 block w-full px-4 py-2 rounded-lg"
          >
            বিস্তারিত দেখুন 
          </button>
        </a>
      @endforeach


        
        <!-- Repeat the above product div for other products -->
      </div>
    </section>


    @endsection
