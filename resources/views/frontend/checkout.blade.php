@extends('layouts/frontendheader')
@section('content')
@if($cart_detail->count()>0)
<section class="w-full py-10">

   <form  method="POST" id="add_order_form" enctype="multipart/form-data">
      <div class="max-w-screen-lg mx-auto px-2 flex flex-wrap ">
        <!-- Left Side: Shipping Address and Payment Method -->
        <div class="w-full lg:w-2/3 mb-8 lg:mb-0 ">
          <!-- Shipping Address Section -->

          @if(empty($address))
          <div class="mb-12 border shadow mt-3 bg-white  pb-3 rounded">
            <h2 class="text-xl p-3 font-semibold mb-4 border-b bg-[#e1e0e078]">Shipping Address</h2>
            <!-- Pick up your parcel from -->
          
          
           <!-- Name and Phone -->
               <div class="flex flex-wrap mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
                 <label class="block mb-2" for="name"> Name </label>
                    <input type="text" name="name" id="name" class="w-full p-2 border rounded" placeholder="Enter your name">
              </div>
              
              <div class="w-full md:w-1/2 px-2 mb-4">
                 <label class="block mb-2" for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="w-full p-2 border rounded" placeholder="Enter your phone number">
              </div>
            </div>


             <!-- city and area -->
            <div class="flex flex-wrap mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
              <label class="block mb-2" for="city">City</label>
                     <select id="district_id" name="district_id" class="w-full p-2 border rounded" required>
                         <option value="">Select City</option>
                           @foreach(district() as $row)
                                <option value="{{$row->id}}"> {{$row->name}}</option>
                           @endforeach
                           <!-- Add options for divisions -->
                     </select>
              </div>
              <div class="w-full md:w-1/2 px-2 mb-4">
                  <label class="block mb-2" for="area">Area</label>
                  <select id="upazila_id" name="upazila_id" class="w-full p-2 border rounded" required>
                         <option value="">Select Area</option>
                          
                           <!-- Add options for divisions -->
                     </select>
              </div>
            
            </div>



              <!-- Zone  and Alternative -->
              <div class="flex flex-wrap mx-2">
              <div class="w-full md:w-1/2 px-2 mb-4">
                <label class="block mb-2" for="area"> Zone</label>
                <select id="union_id" name="union_id" class="w-full p-2 border rounded" required>
                         <option value="">Select Zone</option>          
                     </select>
              </div>
              <div class="w-full md:w-1/2 px-2 mb-4">
                  <label class="block mb-2" for="phone"> Alternative Phone </label>
                  <input type="text"  name="alternative_phone" id="alternative_phone" class="w-full p-2 border rounded" placeholder="Enter your phone number">
              </div>
            
            </div>

           

            <!-- Address -->
            <div class="mb-4 px-2">
            <label class="block mb-2" for="address">Address</label>
                <textarea id="address" name="address" class="w-full p-2 border rounded" rows="2" 
                placeholder="বাসা/ফ্ল্যাট নাম্বর, গ্রামের নাম, পরিচিতির এলাকা উল্লেখ করুন" ></textarea>
            </div>
          </div>

          @endif
          
          <!-- Payment Method Section -->
          <div class="mb-8 border rounded bg-white  shadow-xl">
            <h2 class="text-xl font-semibold p-3 mb-4 bg-[#e1e0e078]">Payment Method</h2>
            <div class="flex flex-col gap-4 p-3">
              <!-- Cash on Delivery -->
              <label
                class="radio-custom flex items-center p-4 border rounded-lg shadow-sm hover:shadow-lg transition-shadow"
              >
                <input type="radio" name="payment_method" value="COD" />
                <span class="radio-label flex items-center">
                  <i
                    class="fa-solid fa-money-bill-wave text-green-500 text-2xl mx-4"
                  ></i>
                  <span class="text-lg font-medium">Cash on Delivery</span>
                </span>
              </label>

          
              <!-- Other Payment Methods -->
              <label
                class="radio-custom flex items-center p-4 border rounded-lg shadow-sm hover:shadow-lg transition-shadow"
              >
                <input type="radio" name="payment_method" value="Online" />
                <span class="radio-label flex items-center">
                  <i
                    class="fa-solid fa-wallet text-purple-500 text-2xl mx-4"
                  ></i>
                  <!-- <span class="text-lg font-medium">Other Payment Methods</span> -->
                  <img
                    src="https://flexiguy.com/assets/FOOTER-aamarPay.png"
                    alt="payment-method"
                    class="w-[90%]"
                  />
                </span>
              </label>
              <p class="my-2 ">প্রিয় গ্রাহক, দেশের বর্তমান পরিস্থিতির কারণে আপনার অর্ডারকৃত পণ্যের ডেলিভারিতে কিছুটা বিলম্ব হতে পারে। আমরা আপনার অর্ডারটি যত দ্রুত সম্ভব পৌঁছে দেওয়ার জন্য সর্বোচ্চ চেষ্টা করছি পনাদের সকলের সহযোগিতা ও ধৈর্য্য কামনা করছি সাময়িক অসুবিধার জন্য আমরা আন্তরিকভাবে দুঃখিত।</p>
              <label
                class="radio-custom flex items-center p-4 border rounded-lg shadow-sm hover:shadow-lg transition-shadow"
              >
                <input type="radio" name="trem" value="term" />
                <span class="radio-label flex items-center">
              
                  <!-- <span class="text-lg font-medium">Other Payment Methods</span> -->
                  প্রতিদিনমার্ট এর শর্তাবলীতে সম্মতি প্রদান করছি ৷ শর্তাবলী
                </span>
              </label>
            </div>
            <div class="ms-auto w-full text-right mt-2 ">
              <button  id="add_order_btn"
                class="bg-blue-500 mb-2 text-white me-10 px-6 py-2 rounded hover:bg-blue-700"
              >
                Confirm Order
              </button>
            </div>
          </div>

          </form>
          <!-- Confirm Order Button -->
        </div>

        <!-- Right Side: Checkout Summary -->
        <div class="w-full lg:w-1/3 p-4 lg:pl-8 ">
          <div class="summary border p-4 rounded bg-white shadow">
            <h2 class="text-xl font-semibold mb-4 border-b-2 border-black pb-4">Checkout Summary</h2>
            <!-- Summary Items -->
            <div class="mb-2 border-b border-dotted pb-2">
              <p class="flex justify-between">
                <span>Subtotal:</span> <span>$399.98</span>
              </p>
            </div>
            <div class="mb-2 border-b border-dotted pb-2">
              <p class="flex justify-between">
                <span>Shipping:</span> <span>$15.00</span>
              </p>
            </div>
            <div class="mb-2 border-b border-dotted pb-2">
              <p class="flex justify-between">
                <span>Tax:</span> <span>$30.00</span>
              </p>
            </div>
            <div class="mb-2">
              <p class="flex justify-between">
                <span>Total:</span> <span>$444.98</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <script src="{{ asset('js/checkout.js') }}"></script>

    @else       
      <script> 
            window.location.href = '/';
      </script>
    @endif



    @endsection
