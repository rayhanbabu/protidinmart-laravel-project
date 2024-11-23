@extends('layouts/frontendheader')
@section('content')

<!-- header -->
<section class="banner mb-5 sm:mb-16">
      <div class="max-w-screen-xl mb-5 mx-auto ">
        <div class="slider">

        @foreach($slider as $row) 
          <div>
            <img
              src="{{asset('uploads/admin/'.$row->image)}}"
              class="w-full  rounded-lg" style="height:350px;"
              alt="Slide 1"
            />
          </div>
         @endforeach
         

        </div>
      </div>
    </section>

    <!-- banner -->
    <!-- <section class="banner mt-5 px-3 mx-auto max-w-screen-lg mb-10">
      <button
        class="block bg-black border-0 uppercase text-white w-full px-3 py-2"
      >
        Welcome to Altabanu
      </button>
      <p class="my-3 text-center">
        Committed to Bringing Unique Traditional Customized Bangladeshi Clothing
        and <br class="hidden sm:block" />
        Handcrafted Jewelry to Your Doorsteps
      </p>
      <img src="images/banner.png" alt="banner image" class="w-full h-auto" />
    </section> -->
    <!-- banner -->

    <!-- product -->
    <section class="max-w-screen-xl mx-auto px-2 border rounded bg-white">
      <div class="p-5 border-b-2">
        <h2 class="text-2xl font-semibold"> @if(Session::get('sale_type')=="Wholesale") খুচরা পণ্য অর্ডার করুণ @else পাইকারি পণ্য অর্ডার করুণ   @endif </h2>
      </div>
      <div
        class="products gap-4 grid mt-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
      >

      @foreach($product as $row) 
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
    <!-- product -->

    <!-- about -->
    <section class="about max-w-screen-xl mx-auto px-2 text-center py-8 my-10">
      <div class="-mt-12">
        <h3 class="uppercase font-bold text-2xl mb-5">About Altabanu</h3>
        <p class="mb-8">
          Since being established in 2020, Altabanu has been known for an
          unparalleled commitment to customer satisfaction. <br />
          It’s this standard of excellence that has provided the impetus for us
          to grow into the business we are today.
        </p>
        <p>
          We believe that the customer always comes first - and that means
          exceptional products and exceptional services. <br />
          Get in touch today to learn more about what we have to offer.
        </p>
        <div class="flex mt-10 items-center justify-evenly">
          <p>for more products</p>
          <a href="">click here</a>
        </div>
      </div>
    </section>
    <!-- about -->

    @endsection
